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
    public $cart = [];

    // Guest Info
    public $full_name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $notes = '';

    // Payment
    public $payment_method = 'cod';
    public $card_number = '';
    public $card_expiry = '';
    public $card_cvc = '';
    public $wallet_number = '';

    public function mount()
    {
        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            return redirect()->route('Home');
        }
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    protected function rules()
    {
        $rules = [
            'full_name'      => 'required|min:3',
            'email'          => 'required|email',
            'phone'          => 'required|min:10',
            'address'        => 'required|min:10',
            'payment_method' => 'required|in:cod,card,easypaisa,jazzcash',
        ];

        if ($this->payment_method === 'card') {
            $rules['card_number'] = 'required|min:16';
            $rules['card_expiry'] = 'required';
            $rules['card_cvc']    = 'required|min:3';
        }

        if (in_array($this->payment_method, ['easypaisa', 'jazzcash'])) {
            $rules['wallet_number'] = 'required|min:11';
        }

        return $rules;
    }

    public function placeOrder()
    {
        $this->validate();

        try {
            $order = DB::transaction(function () {
                $order = Order::create([
                    'user_id'          => null, // Guest order
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

        // ── Stripe / Card Payment ───────────────────────────────
        if ($this->payment_method === 'card') {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'metadata'             => ['order_id' => $order->id],
                    'line_items' => [[
                        'price_data' => [
                            'currency'     => 'pkr',
                            'product_data' => ['name' => 'Guest Order #' . $order->id],
                            'unit_amount'  => (int)($this->total * 100),
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'        => 'payment',
                    'success_url' => route('payment.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'  => route('payment.cancel', $order->id),
                    'customer_email' => $this->email,
                ]);

                // Clear cart before redirecting
                session()->forget('cart');

                // Dispatch event to handle redirect in Blade
                $this->dispatch('redirect-to-stripe', url: $session->url);

                return null;
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

        // ── Cash / Wallet Payment ──────────────────────────────
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