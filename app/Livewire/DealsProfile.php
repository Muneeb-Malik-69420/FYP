<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;
use Livewire\Attributes\On;

class DealsProfile extends Component
{
    public $supplierId;
    public $searchTerm = '';
    public $activeCategory = 'All Deals';

    public function mount($supplier_id = null)
    {
        $this->supplierId = $supplier_id;
    }

    #[On('filterMenu')]
    public function updateFilter($category, $search)
    {
        $this->activeCategory = $category;
        $this->searchTerm = $search;
    }

    public function addToBasket($itemId)
    {
        $item = FoodItem::where('supplier_id', $this->supplierId)
                        ->where('status', 'available')
                        ->findOrFail($itemId);

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {

            if ($cart[$itemId]['quantity'] >= $item->quantity) {
                $this->dispatch('show-toast', message: "No more stock available!");
                return;
            }

            $cart[$itemId]['quantity']++;

        } else {

            $cart[$itemId] = [
                "name" => $item->item_name,
                "quantity" => 1,
                "price" => $item->discounted_price,
                "image" => $item->image_path
            ];
        }

        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');
        $this->dispatch('show-toast', message: "Added {$item->item_name} to basket!");
    }

    public function render()
    {
        $query = FoodItem::where('status', 'available')
                         ->where('supplier_id', $this->supplierId);

        if (!empty($this->searchTerm)) {
            $query->where('item_name', 'like', '%' . $this->searchTerm . '%');
        }

        if ($this->activeCategory !== 'All Deals') {
            $query->where('category', $this->activeCategory);
        }

        $foodItems = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.deals-profile', compact('foodItems'));
    }
}