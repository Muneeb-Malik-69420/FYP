<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class RestaurantBasket extends Component
{
    public array $cart  = [];
    public int   $total = 0;

    /**
     * Initialize the cart on load.
     */
    public function mount(): void
    {
        $this->loadCart();
    }

    /**
     * Reload cart from session whenever any component fires cartUpdated.
     * Guard with a flag so we don't re-read after our OWN dispatches.
     */
    #[On('cartUpdated')]
    public function loadCart(): void
    {
        $this->cart  = session()->get('cart', []);
        $this->calculateTotal();
    }

    /**
     * Route to the appropriate checkout flow.
     */
    public function processCheckout(): mixed
    {
        if (empty($this->cart)) {
            $this->dispatch('show-toast', message: 'Add items to checkout!');
            return null;
        }

        if (auth()->check()) {
            return $this->redirect(route('checkout'), navigate: true);
        }

        return $this->redirect(route('checkout.guest'), navigate: true);
    }

    /**
     * Increase or decrease a single item's quantity from the basket UI.
     */
    public function updateQuantity(int|string $itemId, string $action): void
    {
        if (! isset($this->cart[$itemId])) return;

        if ($action === 'increase') {
            $this->cart[$itemId]['quantity']++;
        } elseif ($action === 'decrease') {
            if ($this->cart[$itemId]['quantity'] > 1) {
                $this->cart[$itemId]['quantity']--;
            } else {
                // Quantity would hit zero — remove the item entirely
                unset($this->cart[$itemId]);
            }
        }

        $this->syncCart();
    }

    /**
     * Remove an entire line item from the cart.
     */
    public function removeFromCart(int|string $itemId): void
    {
        if (! isset($this->cart[$itemId])) return;

        unset($this->cart[$itemId]);
        $this->syncCart();
    }

    /**
     * Clear the entire basket.
     */
    public function clearBasket(): void
    {
        session()->forget('cart');
        $this->cart  = [];
        $this->total = 0;

        $this->dispatch('cartUpdated');
        $this->dispatch('show-toast', message: 'Basket cleared!');
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Persist the current in-memory cart to session, recalculate total,
     * and notify other components.
     */
    private function syncCart(): void
    {
        session()->put('cart', $this->cart);
        $this->calculateTotal();
        $this->dispatch('cartUpdated');
    }

    /**
     * Recalculate the grand total from the current cart.
     */
    private function calculateTotal(): void
    {
        $this->total = (int) collect($this->cart)
            ->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.restaurant-basket');
    }
}