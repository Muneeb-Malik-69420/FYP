<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;
use Livewire\Attributes\On; 

class DealsProfile extends Component
{
    /**
     * The unique identifier for the supplier.
     */
    public $supplierId;

    /**
     * The current search string used to filter menu items.
     */
    public $searchTerm = '';

    /**
     * The currently selected category filter. 
     * Defaulted to 'All Deals'.
     */
    public $activeCategory = 'All Deals';

    /**
     * Initialize the component with the supplier ID passed from the parent view.
     */
    public function mount($supplier_id = null)
    {
        $this->supplierId = $supplier_id;
    }

    /**
     * Listener for the 'filterMenu' event dispatched from the Parent (RestaurantProfile).
     * Updates internal state to trigger a re-render of the filtered grid.
     */
    #[On('filterMenu')]
    public function updateFilter($category, $search)
    {
        $this->activeCategory = $category;
        $this->searchTerm = $search;
        
        // Livewire automatically re-renders after property updates.
    }

    /**
     * Adds a food item to the session-based basket.
     * Dispatches events to refresh the basket and show a toast notification.
     */
    public function addToBasket($itemId)
    {
        // 1. Fetch the item details from the database
        $item = FoodItem::findOrFail($itemId);

        // 2. Retrieve existing cart data from the session
        $cart = session()->get('cart', []);

        // 3. Update quantity if item exists, otherwise add new entry
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++;
        } else {
            $cart[$itemId] = [
                "name" => $item->item_name,
                "quantity" => 1,
                "price" => $item->discounted_price,
                "image" => $item->image_path
            ];
        }

        // 4. Save the updated cart back to the session
        session()->put('cart', $cart);

        // 5. Signal the RestaurantBasket component to refresh its view
        $this->dispatch('cartUpdated');

        // 6. Dispatch a browser event to trigger the floating toast notification
        $this->dispatch('show-toast', message: "Added " . $item->item_name . " to basket!");
    }

    /**
     * Renders the menu grid based on the supplier, active category, and search term.
     */
    public function render()
    {
        // Start query with available items only.
        $query = FoodItem::where('status', 'available');

        // Ensure we are only showing items for this specific supplier.
        if ($this->supplierId) {
            $query->where('supplier_id', $this->supplierId);
        }

        // Apply Real-time Search Filter if a term is provided.
        if (!empty($this->searchTerm)) {
            $query->where('item_name', 'like', '%' . $this->searchTerm . '%');
        }

        // Apply Category Filter unless the user wants to see everything.
        if ($this->activeCategory !== 'All Deals') {
            $query->where('category', $this->activeCategory);
        }

        // Retrieve the final filtered collection.
        $foodItems = $query->get();

        return view('livewire.deals-profile', [
            'foodItems' => $foodItems
        ]);
    }
}