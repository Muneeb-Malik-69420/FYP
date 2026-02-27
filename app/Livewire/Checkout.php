<?php

namespace App\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        // 💎 Safely fetch session data
        $this->cart = session()->get('cart', []);
        
        // 💎 This guard is now 100% stable
        if (empty($this->cart)) {
            return redirect()->to('/explore'); 
        }

        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        // 💎 Explicitly targeting your customer layout
        return view('livewire.checkout')->layout('layout.customer');
    }
}