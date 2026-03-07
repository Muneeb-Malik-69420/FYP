<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;
    public string $customerName = '';

    public function mount(int $id): void
    {
        $this->order = Order::with('items')->findOrFail($id);

        if (auth()->check()) {
            $this->customerName = auth()->user()->name
                ?? auth()->user()->username
                ?? '—';
        } else {
            $this->customerName = $this->order->guest_name ?? '—';
        }

        // Only confirm genuinely pending orders — prevents re-confirming on refresh
        if ($this->order->status === 'pending') {
            $this->order->update(['status' => 'confirmed']);
            $this->order->refresh();

            // Card payment notification (COD is handled in Checkout.php)
            if (auth()->check() && $this->order->payment_method === 'card') {
                Notification::create([
                    'user_id' => auth()->id(),
                    'type'    => 'order_placed',
                    'title'   => 'Payment Confirmed!',
                    'body'    => 'Your order #' . $this->order->id . ' payment was successful. Rs. ' . number_format($this->order->total_amount) . ' · Card',
                    'icon'    => 'fas fa-credit-card',
                    'link'    => null,
                ]);
                $this->dispatch('notification-created');

            }
        }

        // Auth users must own the order
        if (auth()->check() && $this->order->user_id !== null && $this->order->user_id !== auth()->id()) {
            abort(403);
        }
    }

    public function goHome(): mixed
    {
        return $this->redirect(route('Home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.order-success')
            ->layout('layout.customer');
    }
}