<?php

namespace App\Livewire;

use App\Models\Notification;
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
    // -------------------------------------------------------------------------
    // Cart state
    // -------------------------------------------------------------------------

    public array $cart  = [];
    public int   $total = 0;

    // -------------------------------------------------------------------------
    // Form fields
    // -------------------------------------------------------------------------

    public string $name          = '';
    public string $email         = '';
    public string $phone         = '';
    public string $address       = '';
    public string $notes         = '';
    public string $paymentMethod = 'cod';

    // -------------------------------------------------------------------------
    // Lifecycle
    // -------------------------------------------------------------------------

    public function mount(): void
    {
        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            redirect()->to(route('Home'));
            return;
        }

        $this->recalculate();

        if (Auth::check()) {
            $user          = Auth::user();
            $this->name    = $user->username ?? $user->name  ?? '';
            $this->email   = $user->email    ?? '';
            $this->phone   = $user->phone    ?? '';
            $this->address = $user->address  ?? '';
        }
    }

    // -------------------------------------------------------------------------
    // Validation
    // -------------------------------------------------------------------------

    protected function rules(): array
    {
        $rules = [
            'address'       => ['required', 'string', 'min:10'],
            'notes'         => ['nullable', 'string', 'max:500'],
            'paymentMethod' => ['required', 'in:cod,card'],
        ];

        if (! Auth::check()) {
            $rules['name']  = ['required', 'string', 'min:3'];
            $rules['email'] = ['required', 'email'];
            $rules['phone'] = ['required', 'digits:11'];
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'name.required'    => 'Please enter your full name.',
            'email.required'   => 'Please enter your email address.',
            'email.email'      => 'Please enter a valid email address.',
            'phone.required'   => 'Please enter your phone number.',
            'phone.digits'     => 'Phone number must be 11 digits.',
            'address.required' => 'Please enter your delivery address.',
            'address.min'      => 'Please enter a more complete address.',
        ];
    }

    // -------------------------------------------------------------------------
    // Actions
    // -------------------------------------------------------------------------

    public function placeOrder(): mixed
    {
        $this->validate();

        $user = Auth::user();

        if ($user) {
            $patch = [];
            if (empty($user->phone)   && filled($this->phone))   $patch['phone']   = $this->phone;
            if (empty($user->address) && filled($this->address)) $patch['address'] = $this->address;
            if ($patch) $user->update($patch);
        }

        // ── Create order + line items ────────────────────────────────────────
        try {
            $order = DB::transaction(function () use ($user) {
                $order = Order::create($user ? [
                    'user_id'          => $user->id,
                    'total_amount'     => $this->total,
                    'status'           => 'pending',
                    'payment_method'   => $this->paymentMethod,
                    'delivery_address' => $this->address,
                    'phone'            => $user->phone ?: $this->phone,
                    'notes'            => $this->notes ?: null,
                ] : [
                    'user_id'          => null,
                    'guest_name'       => $this->name,
                    'guest_email'      => $this->email,
                    'total_amount'     => $this->total,
                    'status'           => 'pending',
                    'payment_method'   => $this->paymentMethod,
                    'delivery_address' => $this->address,
                    'phone'            => $this->phone,
                    'notes'            => $this->notes ?: null,
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
            Log::error('Order creation failed', [
                'user'  => $user?->id ?? 'guest',
                'error' => $e->getMessage(),
            ]);
            $this->addError('order', 'Something went wrong placing your order. Please try again.');
            return null;
        }

        // ── Stripe (card) ────────────────────────────────────────────────────
        if ($this->paymentMethod === 'card') {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'metadata'             => ['order_id' => $order->id],
                    'line_items'           => [[
                        'price_data' => [
                            'currency'     => 'pkr',
                            'product_data' => ['name' => 'Order #' . $order->id],
                            'unit_amount'  => (int) ($this->total * 100),
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'           => 'payment',
                    'success_url'    => route('payment.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'     => route('payment.cancel',  $order->id),
                    'customer_email' => $user?->email ?? $this->email,
                ]);

                session()->forget('cart');
                return redirect()->away($session->url);

            } catch (Throwable $e) {
                $order->update(['status' => 'payment_failed']);
                Log::error('Stripe session creation failed', [
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

        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'order_placed',
                'title'   => 'Order Confirmed!',
                'body'    => 'Your order #' . $order->id . ' has been placed successfully. Rs. ' . number_format($this->total) . ' · Cash on Delivery',
                'icon'    => 'fas fa-check-circle',
                'link'    => route('order.success'),
            ]);
        }
$this->dispatch('notification-created');

        $this->dispatch('show-toast', message: 'Order placed successfully!');
        return redirect()->route('order.success');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function recalculate(): void
    {
        $this->total = (int) collect($this->cart)
            ->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------

    public function render()
    {
        return view('livewire.checkout')
            ->layout('layout.customer');
    }
}