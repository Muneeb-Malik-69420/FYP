<?php

namespace App\Livewire;

use App\Models\FoodItem;
use App\Models\Supplier;
use Livewire\Component;

class RestaurantProfile extends Component
{
    // -------------------------------------------------------------------------
    // State
    // -------------------------------------------------------------------------

    public Supplier $supplier;
    public string   $activeCategory = 'All Deals';
    public string   $search         = '';

    // -------------------------------------------------------------------------
    // Lifecycle
    // -------------------------------------------------------------------------

    public function mount(int $id): void
    {
        $this->supplier = Supplier::findOrFail($id);
    }

    // -------------------------------------------------------------------------
    // Actions
    // -------------------------------------------------------------------------

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
        // No dispatch needed — render() reacts to property change automatically
    }

    /**
     * Livewire calls this automatically when $search changes via wire:model.
     * Nothing extra needed — render() re-runs on any property update.
     */

    public function addToBasket(int $itemId): void
    {
        $item = FoodItem::where('supplier_id', $this->supplier->id)
            ->where('status', 'available')
            ->findOrFail($itemId);

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            // Respect stock ceiling
            if ($cart[$itemId]['quantity'] >= $item->quantity) {
                $this->dispatch('show-toast', message: 'No more stock available!', type: 'error');
                return;
            }
            $cart[$itemId]['quantity']++;
        } else {
            $cart[$itemId] = [
                'name'           => $item->item_name,
                'price'          => (float) $item->discounted_price,
                'original_price' => (float) $item->original_price,
                'quantity'       => 1,
                'image'          => $item->image_path,
            ];
        }

        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');
        $this->dispatch('show-toast', message: "Added {$item->item_name} to basket!");
    }

    public function closeRestaurant(): mixed
    {
        return $this->redirect(route('Home'), navigate: true);
    }
    public function toggleFavourite(): void
    {
        if (!auth()->check()) return;

        $existing = \App\Models\Favourite::where('user_id', auth()->id())
            ->where('supplier_id', $this->supplier->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $this->dispatch('show-toast', message: 'Removed from favourites', type: 'error');
        } else {
            \App\Models\Favourite::create([
                'user_id'     => auth()->id(),
                'supplier_id' => $this->supplier->id,
            ]);
            $this->dispatch('show-toast', message: 'Added to favourites!', type: 'success');
        }
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------

    public function render()
    {
        // Categories for this supplier
        $categories = FoodItem::where('supplier_id', $this->supplier->id)
            ->where('status', 'available')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->filter()
            ->prepend('All Deals')
            ->values();

        // Filtered deals query
        $foodItems = FoodItem::where('supplier_id', $this->supplier->id)
            ->where('status', 'available')
            ->when(
                $this->activeCategory !== 'All Deals',
                fn($q) =>
                $q->where('category', $this->activeCategory)
            )
            ->when(
                trim($this->search) !== '',
                fn($q) =>
                $q->where(function ($sub) {
                    $term = '%' . trim($this->search) . '%';
                    $sub->where('item_name',   'like', $term)
                        ->orWhere('description', 'like', $term);
                })
            )
            ->orderByRaw('quantity > 0 DESC') // sold-out items sink to bottom
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.restaurant-profile', [
            'categories' => $categories,
            'foodItems'  => $foodItems,
        ])->layout('layout.customer');
    }
}
