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