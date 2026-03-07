<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;

class CartDrawer extends Component
{
    public bool $open = false;

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function openDrawer(): void
    {
        $this->open = true;
    }

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
            array_map(fn($i) => isset($i['original_price'])
                ? ($i['original_price'] - $i['price']) * $i['quantity']
                : 0,
            $this->cart)
        );
    }

    public function updateQuantity(int $itemId, string $action): void
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$itemId])) return;

        if ($action === 'increase') {
            $max       = $cart[$itemId]['max_quantity'] ?? PHP_INT_MAX;
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
                unset($cart[$itemId]);
                session()->put('cart', $cart);

                if (empty($cart)) {
                    session()->forget('cart_supplier_id');
                }

                $this->dispatch('cartUpdated');
                $this->dispatch('cart-updated');
                return;
            }
            $cart[$itemId]['quantity']--;
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('cart-updated');
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
        $this->dispatch('cart-updated');
        $this->dispatch('show-toast', message: 'Item removed.');
    }

    public function clearBasket(): void
    {
        session()->forget('cart');
        session()->forget('cart_supplier_id');

        $this->dispatch('cartUpdated');
        $this->dispatch('cart-updated');
    }

    public function processCheckout(): mixed
    {
        if (empty($this->cart)) {
            $this->dispatch('show-toast',
                message: 'Your basket is empty.',
                type: 'error'
            );
            return null;
        }

        return $this->redirect(route('checkout'), navigate: true);
    }

    public function render()
    {
        return view('livewire.cart-drawer', [
            'cart'      => $this->cart,
            'itemCount' => $this->itemCount,
            'total'     => $this->total,
            'savings'   => $this->savings,
        ]);
    }
}