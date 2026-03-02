<?php

namespace App\Livewire;

use Livewire\Component;

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
        return collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    protected function rules()
    {
        $rules = [
            'full_name' => 'required|min:3',
            'email'     => 'required|email',
            'phone'     => 'required|min:10',
            'address'   => 'required|min:10',
            'payment_method' => 'required',
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

        // TODO:
        // Save order to DB
        // Process payment if needed

        session()->forget('cart');

        $this->dispatch('show-toast', message: "Order placed successfully!");

        return $this->redirect(route('Home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.guest-checkout')->layout('layout.customer
        ');
    }
}