<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Throwable;

class Checkout extends Component
{
    public array $cart  = [];
    public int   $total = 0;

    // Form fields
    public string $name          = '';
    public string $phone         = '';
    public string $address       = '';
    public string $paymentMethod = 'cod'; // 'cod' | 'card'

    protected array $rules = [
        'name'          => 'required|string|min:3',
        'address'       => 'required|string|min:10',
        'phone'         => 'required|digits:11',
        'paymentMethod' => 'required|in:cod,card',
    ];

    public function mount(): void
    {
        // Guest guard — Auth::user() would be null for guests
        if (! Auth::check()) {
            redirect()->route('checkout.guest');
            return;
        }

        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            redirect()->to('/explore');
            return;
        }

        $user = Auth::user();

        $this->name    = $user->username ?? $user->name ?? '';
        $this->phone   = $user->phone   ?? '';
        $this->address = $user->address ?? '';

        $this->total = (int) collect($this->cart)
            ->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function placeOrder(): mixed
    {
        $this->validate();

        $user = Auth::user();

        // Persist any newly-provided contact details to the user profile
        $profileUpdate = [];
        if (empty($user->phone)   && filled($this->phone))   $profileUpdate['phone']   = $this->phone;
        if (empty($user->address) && filled($this->address)) $profileUpdate['address'] = $this->address;
        if ($profileUpdate) {
            $user->update($profileUpdate);
        }

        // Wrap order + items in a transaction so we never get a header without line items
        try {
            $order = DB::transaction(function () use ($user) {
                $order = Order::create([
                    'user_id'          => $user->id,
                    'total_amount'     => $this->total,
                    'status'           => 'pending',
                    'payment_method'   => $this->paymentMethod,
                    'delivery_address' => $this->address,
                    'phone'            => $this->phone,
                ]);

                foreach ($this->cart as $productId => $item) {
                    OrderItem::create([
                        'order_id'   => $order->id,
                        // Cart items are keyed by product ID; 'id' inside the
                        // array may or may not exist depending on how you build
                        // the cart — fall back to the array key if missing.
                        'product_id' => $item['id'] ?? $productId,
                        'name'       => $item['name'],
                        'price'      => $item['price'],
                        'quantity'   => $item['quantity'],
                        'subtotal'   => $item['price'] * $item['quantity'],
                    ]);
                }

                return $order;
            });
        } catch (Throwable $e) {
            Log::error('Order creation failed', ['error' => $e->getMessage()]);
            $this->addError('order', 'Something went wrong while placing your order. Please try again.');
            return null;
        }

        // ── Stripe ───────────────────────────────────────────────────────────
       if ($this->paymentMethod === 'card') {
    try {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            // Add metadata so we can identify this order on the success page or via webhooks
            'metadata' => [
                'order_id' => $order->id,
            ],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'pkr',
                    'product_data' => ['name' => 'Order #' . $order->id],
                    'unit_amount'  => (int)($this->total * 100), 
                ],
                'quantity' => 1,
            ]],
            'mode'           => 'payment',
            'success_url'    => route('payment.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'     => route('payment.cancel',  $order->id),
            'customer_email' => $user->email,
        ]);

        return redirect()->away($session->url);

    } catch (Throwable $e) {
                // Mark the order so it can be retried or cleaned up
                $order->update(['status' => 'payment_failed']);
                Log::error('Stripe session creation failed', [
                    'order_id' => $order->id,
                    'error'    => $e->getMessage(),
                ]);
                $this->addError('order', 'Payment gateway error. Please try again or choose Cash on Delivery.');
                return null;
            }

            // Clear the cart only after we have a confirmed Stripe session URL
            session()->forget('cart');

            // redirect()->away() is unreliable inside Livewire — dispatch a
            // browser event and handle it in the Blade view with:
            // x-on:redirect-to-stripe.window="window.location.href = $event.detail.url"
            $this->dispatch('redirect-to-stripe', url: $session->url);
            return null;
        }

        // ── Cash on Delivery ─────────────────────────────────────────────────
        $order->update(['status' => 'confirmed']);
        session()->forget('cart');

        $this->dispatch('show-toast', message: 'Order placed successfully!');

        return redirect()->route('order.success');
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layout.customer');
    }
}
