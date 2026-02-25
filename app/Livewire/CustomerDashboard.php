<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\City;
use App\Models\FoodItem;
use Livewire\Attributes\On;

class CustomerDashboard extends Component
{
    public $selectedCity;
    public $searchQuery = '';

    public function mount()
    {
        $this->selectedCity = session('user_city', 'Jhelum');
    }

    /**
     * Listen for the event from CustomerSearch.
     * Note: In your CustomerSearch, you passed an array ['city' => ..., 'search' => ...]
     */
    #[On('filtersUpdated')]
    public function updateFilters($data)
    {
        $this->selectedCity = $data['city'];
        $this->searchQuery = $data['search'];
    }

    public function render()
    {
        // 1. Fetch Surplus Items (Deals)
        $surplusItems = FoodItem::whereHas('supplier', function ($query) {
            $query->where('status', 'approved') // Only approved suppliers
                  ->whereHas('city', function ($q) {
                      $q->where('name', $this->selectedCity);
                  });
        })
        ->when($this->searchQuery, function ($query) {
            // Note: Ensure your column name is 'name' or 'item_name'
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        })
        ->with('supplier')
        ->latest()
        ->get();

        // 2. Fetch Restaurants
        $suppliers = Supplier::where('status', 'approved')
            ->whereHas('city', function ($query) {
                $query->where('name', $this->selectedCity);
            })
            ->when($this->searchQuery, function ($query) {
                $query->where('business_name', 'like', '%' . $this->searchQuery . '%');
            })
            ->get();

        return view('livewire.customer-dashboard', [
            'surplusItems' => $surplusItems,
            'suppliers' => $suppliers,
        ]);
    }
}