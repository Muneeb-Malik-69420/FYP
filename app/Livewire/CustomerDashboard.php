<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SurplusItem;
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
        // Default to Jhelum or session value
        $this->selectedCity = session('user_city', 'Jhelum');
    }

    /**
     * This listens for the 'filtersUpdated' event dispatched 
     * from your CustomerSearch component.
     */
    #[On('filtersUpdated')]
    public function updateFilters($data)
    {
        $this->selectedCity = $data['city'];
        $this->searchQuery = $data['search'];
    }

    public function render()
    {
        $cityModel = City::where('name', $this->selectedCity)->first();

$surplusItems = FoodItem::whereHas('supplier', function($q) use ($cityModel) {
    $q->where('city_id', $cityModel->id ?? 0);
})->get();
        // 1. Filter Surplus Items based on City and Search
        $surplusItems = FoodItem::whereHas('supplier.city', function ($query) {
            $query->where('name', $this->selectedCity);
        })
        ->when($this->searchQuery, function ($query) {
            $query->where('item_name', 'like', '%' . $this->searchQuery . '%');
        })
        ->with('supplier') // Eager load for performance
        ->latest()
        ->get();

        // 2. Filter Suppliers based on City and Search
        $suppliers = Supplier::whereHas('city', function ($query) {
            $query->where('name', $this->selectedCity);
        })
        ->when($this->searchQuery, function ($query) {
            $query->where('business_name', 'like', '%' . $this->searchQuery . '%');
        })
        ->where('is_verified', true)
        ->get();

        return view('livewire.customer-dashboard', [
            'surplusItems' => $surplusItems,
            'suppliers' => $suppliers,
        ]);
    }
}