<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $cart = [];
    public $total = 0;
    
    // Form fields for user information
    public $name;
    public $phone;
    public $address;
    public $paymentMethod = 'cod'; // Defaulting to Cash on Delivery

    /**
     * Validation rules to ensure delivery data is captured.
     */
    protected $rules = [
        'name' => 'required|string|min:3',
        'address' => 'required|string|min:10',
        'phone' => 'required|digits:11',
        'paymentMethod' => 'required'
    ];

    public function mount()
    {
        // Fetch cart from session
        $this->cart = session()->get('cart', []);
        
        // Safety: If cart is empty, redirect back to menu
        if (empty($this->cart)) {
            return redirect()->to('/explore'); 
        }

        // Auto-fill available details from the authenticated user
        $user = Auth::user();
        $this->name = $user->username;
        $this->phone = $user->phone ?? ''; 
        $this->address = $user->address ?? '';

        // Calculate order total
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    /**
     * Finalizes the order and updates user profile if data was missing.
     */
    public function placeOrder()
    {
        // Trigger validation before processing
        $this->validate();

        $user = Auth::user();

        // 💎 Profile Update: Save address/phone if they were previously empty
        // This ensures the next checkout is truly "Express."
        if (empty($user->address) || empty($user->phone)) {
            $user->update([
                'address' => $this->address,
                'phone' => $this->phone,
            ]);
        }

        /** * 🚀 ORDER PROCESSING LOGIC 
         * This is where you would create the Order record in your database.
         * Example: Order::create([...]);
         */

        // Clear the cart session after successful order
        session()->forget('cart');

        // Provide feedback and redirect to a success page
        $this->dispatch('show-toast', message: "Order placed successfully!");
        return redirect()->route('order.success'); 
    }

    public function render()
    {
        // Use the explicit customer layout
        return view('livewire.checkout')->layout('layout.customer');
    }
}