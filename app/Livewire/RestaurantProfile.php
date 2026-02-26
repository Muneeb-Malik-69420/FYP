<?php

namespace App\Livewire;

use App\Models\FoodItem;
use App\Models\Supplier;
use Livewire\Component;

class RestaurantProfile extends Component
{
    /**
     * The supplier model instance.
     */
    public $supplier;
    
    /**
     * The currently active category for the navigation highlight.
     * Defaulted to 'All Deals'.
     */
    public $activeCategory = 'All Deals'; 

    /**
     * The real-time search string from the search bar.
     */
    public $search = '';

    /**
     * Initialize the component with the supplier ID from the route.
     */
    public function mount($id) 
    {
        $this->supplier = Supplier::findOrFail($id);
    }

    /**
     * Updates the active category and dispatches a signal to the DealsProfile component.
     * This keeps the menu grid in sync with the navigation bar.
     */
    public function setCategory($category)
    {
        $this->activeCategory = $category;

        // Tell the Child (DealsProfile) to filter its results.
        $this->dispatch('filterMenu', category: $category, search: $this->search);
    }

    /**
     * Lifecycle hook that fires every time the search input changes.
     * It ensures the menu grid filters as the user types.
     */
    public function updatedSearch()
    {
        // Real-time search update for the child component.
        $this->dispatch('filterMenu', category: $this->activeCategory, search: $this->search);
    }

    /**
     * Renders the view with dynamic categories pulled from the supplier's food items.
     */
    public function render()
    {
        // Fetch unique categories belonging to this specific supplier.
        $categories = FoodItem::where('supplier_id', $this->supplier->id)
            ->where('status', 'available')
            ->distinct()
            ->pluck('category')
            ->prepend('All Deals');

        return view('livewire.restaurant-profile', [
            'categories' => $categories
        ])->layout('layout.customer');
    }
}