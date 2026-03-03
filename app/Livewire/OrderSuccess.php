<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public $order;

    public function mount($id)
    {
        // 1. Find the order by the ID passed in the URL
        $this->order = Order::findOrFail($id);

        // 2. If it's still 'pending', update it to 'confirmed'
        // This is the "Switch" that flips the status in your database
        if ($this->order->status === 'pending' || $this->order->status === 'payment_failed') {
            $this->order->update([
                'status' => 'confirmed',
                // 'payment_status' => 'paid', // Uncomment if you have this column
            ]);
            
            // Optional: Send an email or clear a session cart here
            // session()->forget('cart');
        }
    }

    public function render()
    {
        return view('livewire.order-success')
            ->layout('layout.customer');
    }
}