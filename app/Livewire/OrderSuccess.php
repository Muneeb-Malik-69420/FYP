<?php

namespace App\Livewire;

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

        \Log::info('OrderSuccess debug', [
            'auth_id'       => auth()->id(),
            'auth_name'     => auth()->user()?->name,
            'auth_username' => auth()->user()?->username,
            'customerName'  => $this->customerName,
        ]);

        // Only confirm genuinely pending orders — prevents re-confirming on refresh
        if ($this->order->status === 'pending') {
            $this->order->update(['status' => 'confirmed']);
            $this->order->refresh();
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