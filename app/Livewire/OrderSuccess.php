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

        // Resolve name now and store as a plain string —
        // Livewire drops loaded relationships during serialization
        // so we can't rely on $order->user->name in the blade
        $this->customerName = $this->order->user?->name
            ?? $this->order->guest_name
            ?? '—';

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
        return $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.order-success')
            ->layout('layout.customer');
    }
}