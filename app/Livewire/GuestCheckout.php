<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Throwable;

class GuestCheckout extends Component
{
    public array $cart = [];

    // Guest info
    public string $full_name      = '';
    public string $email          = '';
    public string $phone          = '';
    public string $address        = '';
    public string $notes          = '';

    // Payment
    public string $payment_method = 'cod'; // 'cod' | 'card'

    protected array $rules = [
        'full_name'      => 'required|string|min:3',
        'email'          => 'required|email',
        'phone'          => 'required|digits:11',
        'address'        => 'required|string|min:10',
        'payment_method' => 'required|in:cod,card',
        'notes'          => 'nullable|string|max:500',
    ];

    public function mount(): void
    {
        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            redirect()->route('Home');
            return;
        }
    }

    public function getTotalProperty(): int
    {
        return (int) collect($this->cart)
            ->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function placeOrder(): mixed
    {
        $this->validate();

        // ── Create order + items in a transaction ────────────────────────────
        try {
            $order = DB::transaction(function () {
                $order = Order::create([
                    'user_id'          => null,
                    'total_amount'     => $this->total,
                    'status'           => 'pending',
                    'payment_method'   => $this->payment_method,
                    'delivery_address' => $this->address,
                    'phone'            => $this->phone,
                    'guest_name'       => $this->full_name,
                    'guest_email'      => $this->email,
                    'notes'            => $this->notes,
                ]);

                foreach ($this->cart as $productId => $item) {
                    OrderItem::create([
                        'order_id'   => $order->id,
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
            Log::error('Guest order creation failed', ['error' => $e->getMessage()]);
            $this->addError('order', 'Something went wrong while placing your order. Please try again.');
            return null;
        }

        // ── Stripe ───────────────────────────────────────────────────────────
        if ($this->payment_method === 'card') {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'metadata'             => ['order_id' => $order->id],
                    'line_items'           => [[
                        'price_data' => [
                            'currency'     => 'pkr',
                            'product_data' => ['name' => 'Guest Order #' . $order->id],
                            'unit_amount'  => (int) ($this->total * 100),
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'           => 'payment',
                    'success_url'    => route('payment.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'     => route('payment.cancel', $order->id),
                    'customer_email' => $this->email,
                ]);

                // Clear cart BEFORE redirecting away — redirect() ends execution
                session()->forget('cart');

                return redirect()->away($session->url);

            } catch (Throwable $e) {
                $order->update(['status' => 'payment_failed']);
                Log::error('Stripe session creation failed for guest', [
                    'order_id' => $order->id,
                    'error'    => $e->getMessage(),
                ]);
                $this->addError('order', 'Payment gateway error. Please try again or choose Cash on Delivery.');
                return null;
            }
        }

        // ── Cash on Delivery ─────────────────────────────────────────────────
        $order->update(['status' => 'confirmed']);
        session()->forget('cart');
        $this->dispatch('show-toast', message: 'Order placed successfully!');

        return redirect()->route('order.success');
    }

    public function render()
    {
        return view('livewire.guest-checkout')->layout('layout.customer');
    }
}