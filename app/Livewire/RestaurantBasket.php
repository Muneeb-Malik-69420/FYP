<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;

class RestaurantBasket extends Component
{
    // -------------------------------------------------------------------------
    // Listeners
    // -------------------------------------------------------------------------

    protected $listeners = ['cartUpdated' => '$refresh'];

    // -------------------------------------------------------------------------
    // Computed helpers
    // -------------------------------------------------------------------------

    public function getCartProperty(): array
    {
        return session()->get('cart', []);
    }

    public function getItemCountProperty(): int
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    public function getTotalProperty(): float
    {
        return array_sum(
            array_map(fn($i) => $i['price'] * $i['quantity'], $this->cart)
        );
    }

    public function getSavingsProperty(): float
    {
        return array_sum(
            array_map(fn($i) => (
                isset($i['original_price'])
                    ? ($i['original_price'] - $i['price']) * $i['quantity']
                    : 0
            ), $this->cart)
        );
    }

    // -------------------------------------------------------------------------
    // Actions
    // -------------------------------------------------------------------------

    public function updateQuantity(int $itemId, string $action): void
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$itemId])) return;

        if ($action === 'increase') {
            // Enforce max_quantity ceiling stored at add-time
            $max = $cart[$itemId]['max_quantity'] ?? PHP_INT_MAX;

            // Also re-check live stock in case it changed
            $liveStock = FoodItem::find($itemId)?->quantity ?? 0;
            $ceiling   = min($max, $liveStock);

            if ($cart[$itemId]['quantity'] >= $ceiling) {
                $this->dispatch('show-toast',
                    message: "Only {$ceiling} available — that's the max!",
                    type: 'error'
                );
                return;
            }
            $cart[$itemId]['quantity']++;

        } elseif ($action === 'decrease') {
            if ($cart[$itemId]['quantity'] <= 1) {
                // Remove item entirely when decremented to zero
                unset($cart[$itemId]);
                session()->put('cart', $cart);

                if (empty($cart)) {
                    session()->forget('cart_supplier_id');
                }

                $this->dispatch('cartUpdated');
                return;
            }
            $cart[$itemId]['quantity']--;
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
    }

    public function removeFromCart(int $itemId): void
    {
        $cart = session()->get('cart', []);
        unset($cart[$itemId]);
        session()->put('cart', $cart);

        if (empty($cart)) {
            session()->forget('cart_supplier_id');
        }

        $this->dispatch('cartUpdated');
        $this->dispatch('show-toast', message: 'Item removed.');
    }

    public function clearBasket(): void
    {
        session()->forget('cart');
        session()->forget('cart_supplier_id');
        $this->dispatch('cartUpdated');
    }

    public function processCheckout(): mixed
    {
        if (empty($this->cart)) {
            $this->dispatch('show-toast', message: 'Your basket is empty.', type: 'error');
            return null;
        }

        return $this->redirect(route('checkout'), navigate: true);
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------

    public function render()
    {
        return view('livewire.restaurant-basket', [
            'cart'      => $this->cart,
            'itemCount' => $this->itemCount,
            'total'     => $this->total,
            'savings'   => $this->savings,
        ]);
    }
}