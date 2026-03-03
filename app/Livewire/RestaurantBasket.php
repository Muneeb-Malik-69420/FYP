<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class RestaurantBasket extends Component
{
    public array $cart     = [];
    public float $total    = 0.0;
    public float $savings  = 0.0;
    public int   $itemCount = 0;

    /**
     * Maximum quantity allowed per line item.
     */
    private const MAX_QTY = 99;

    // -------------------------------------------------------------------------
    // Lifecycle
    // -------------------------------------------------------------------------

    public function mount(): void
    {
        $this->loadCart();
    }

    // -------------------------------------------------------------------------
    // Event listeners
    // -------------------------------------------------------------------------

    /**
     * Reload cart when another component signals a change.
     * The `$fromSelf` guard prevents re-reading after our own dispatches,
     * avoiding the cartUpdated → loadCart → cartUpdated loop.
     */
    #[On('cartUpdated')]
    public function loadCart(bool $fromSelf = false): void
    {
        if ($fromSelf) return;

        $this->cart = session()->get('cart', []);
        $this->recalculate();
    }

    // -------------------------------------------------------------------------
    // Public actions
    // -------------------------------------------------------------------------

    /**
     * Increase or decrease a single item's quantity.
     */
    public function updateQuantity(int|string $itemId, string $action): void
    {
        if (! isset($this->cart[$itemId])) return;

        // Validate action to prevent arbitrary input
        if (! in_array($action, ['increase', 'decrease'], true)) return;

        if ($action === 'increase') {
            $current = $this->cart[$itemId]['quantity'];
            if ($current >= self::MAX_QTY) {
                $this->dispatch('show-toast', message: 'Maximum quantity reached!', type: 'error');
                return;
            }
            $this->cart[$itemId]['quantity']++;
        } else {
            if ($this->cart[$itemId]['quantity'] > 1) {
                $this->cart[$itemId]['quantity']--;
            } else {
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

        $name = $this->cart[$itemId]['name'] ?? 'Item';
        unset($this->cart[$itemId]);

        $this->syncCart();
        $this->dispatch('show-toast', message: "{$name} removed.", type: 'error');
    }

    /**
     * Clear the entire basket.
     */
    public function clearBasket(): void
    {
        session()->forget('cart');
        $this->cart      = [];
        $this->total     = 0.0;
        $this->savings   = 0.0;
        $this->itemCount = 0;

        // Notify OTHER components — pass fromSelf so our own listener skips
        $this->dispatch('cartUpdated', fromSelf: true);
        $this->dispatch('basket-updated', count: 0); // for mobile badge
        $this->dispatch('show-toast', message: 'Basket cleared!');
    }

    /**
     * Route to the appropriate checkout flow.
     */
    public function processCheckout(): mixed
    {
        if (empty($this->cart)) {
            $this->dispatch('show-toast', message: 'Your basket is empty!', type: 'error');
            return null;
        }

        return auth()->check()
            ? $this->redirect(route('checkout'), navigate: true)
            : $this->redirect(route('checkout.guest'), navigate: true);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Persist cart to session, recalculate totals, and notify other components.
     */
    private function syncCart(): void
    {
        session()->put('cart', $this->cart);
        $this->recalculate();

        $this->dispatch('cartUpdated', fromSelf: true);
        $this->dispatch('basket-updated', count: $this->itemCount); // mobile badge
    }

    /**
     * Recalculate total, savings, and item count from the current cart.
     * Relies on each cart item having: price, original_price (optional), quantity.
     */
    private function recalculate(): void
    {
        $total    = 0.0;
        $savings  = 0.0;
        $count    = 0;

        foreach ($this->cart as $item) {
            $qty   = (int)   ($item['quantity']       ?? 1);
            $price = (float) ($item['price']          ?? 0);
            $orig  = (float) ($item['original_price'] ?? $price);

            $total   += $price * $qty;
            $savings += ($orig - $price) * $qty;
            $count   += $qty;
        }

        $this->total     = round($total,   2);
        $this->savings   = round($savings, 2);
        $this->itemCount = $count;
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------

    public function render()
    {
        return view('livewire.restaurant-basket');
    }
}