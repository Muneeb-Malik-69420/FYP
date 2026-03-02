<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class RestaurantBasket extends Component
{
    public $cart = [];
    public $total = 0;

    /**
     * Initialize the cart data on load.
     */
    public function mount()
    {
        $this->loadCart();
    }

    /**
     * Listener to refresh the basket state whenever the cart changes.
     */
    #[On('cartUpdated')]
    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotal();
    }

    /**
     * Handles the final checkout process with a simulated delay for the spinner.
     */
    // public function processCheckout()
    // {
    //     if (empty($this->cart)) return;

    //     // Simulate a delay for the server-side process
    //     sleep(1);

    //     // Success Feedback
    //     $this->dispatch('show-toast', message: "Order placed successfully!");

    //     // Reset the state after successful checkout
    //     $this->clearBasket();
    // }
    public function processCheckout()
{
    if (empty($this->cart)) {
        $this->dispatch('show-toast', message: "Add items to checkout!");
        return;
    }

    // Step 1: If logged in, go to the streamlined Express Checkout
    if (auth()->check()) {
        return $this->redirect(route('checkout'),navigate: true); 
    }

    // Step 2: If guest, go to the page where they can choose Social Login or Guest Flow
    return $this->redirect(route('checkout.guest'),navigate: true); 
}

    /**
     * Calculates the grand total of all items in the basket.
     */
    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    /**
     * 💎 FIX: Handles increasing or decreasing quantity from the sidebar pill.
     */
    public function updateQuantity($itemId, $action)
    {
        if (isset($this->cart[$itemId])) {
            if ($action === 'increase') {
                $this->cart[$itemId]['quantity']++;
            } elseif ($action === 'decrease' && $this->cart[$itemId]['quantity'] > 1) {
                $this->cart[$itemId]['quantity']--;
            }

            session()->put('cart', $this->cart);
            $this->calculateTotal();
            
            // Notify other components (like DealsProfile) to update their quantity displays
            $this->dispatch('cartUpdated');
        }
    }

    /**
     * 💎 FIX: Added missing method to resolve BadMethodCallException.
     */
    public function clearBasket()
    {
        session()->forget('cart');
        $this->cart = [];
        $this->total = 0;
        
        $this->dispatch('cartUpdated');
        $this->dispatch('show-toast', message: "Basket cleared!");
    }

    /**
     * Removes an entire item line from the cart.
     */
    public function removeFromCart($itemId)
    {
        if (isset($this->cart[$itemId])) {
            unset($this->cart[$itemId]);
            session()->put('cart', $this->cart);
            $this->loadCart();
        }
    }

    /**
     * Decreases quantity or removes item if quantity hits zero (Matches card logic).
     */
    public function removeFromBasket($itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            if ($cart[$itemId]['quantity'] > 1) {
                $cart[$itemId]['quantity']--;
            } else {
                unset($cart[$itemId]);
            }
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.restaurant-basket');
    }
}