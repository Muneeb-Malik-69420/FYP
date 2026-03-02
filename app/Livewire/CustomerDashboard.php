<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;

class CustomerDashboard extends Component
{
    public $selectedCity;
    public $searchQuery = '';
    public $businessType = ''; // <--- Add this

    public function mount()
    {
        $this->selectedCity = session('user_city', 'Jhelum');
    }

    #[On('filtersUpdated')]
    public function updateFilters($data)
    {
        $this->selectedCity = $data['city'];
        $this->searchQuery = $data['search'];
    }

    // --- Add this new listener ---
    #[On('filter-by-type')]
    public function updateBusinessType($type)
    {
        $this->businessType = $type;
    }

    public function render()
{
    $suppliers = Supplier::where('status', 'approved')
        // Ensure the supplier has at least one food item with quantity > 0
        ->whereHas('foodItems', function ($q) {
            $q->where('quantity', '>', 0);
        })
        ->whereHas('city', function ($query) {
            $query->where('name', $this->selectedCity);
        })
        ->when($this->businessType, function ($query) {
            $query->where('business_type', $this->businessType); 
        })
        ->when($this->searchQuery, function ($query) {
            $query->where(function ($q) {
                $q->where('business_name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhereHas('foodItems', function ($foodQ) {
                      $foodQ->where('item_name', 'like', '%' . $this->searchQuery . '%')
                            ->where('quantity', '>', 0); // Keep search relevant to active items
                  });
            });
        })
        // Also keep 'with' so the items are eager-loaded for the view
        ->with(['foodItems' => function($q) {
            $q->where('quantity', '>', 0);
        }])
        ->get();

    return view('livewire.customer-dashboard', [
        'suppliers' => $suppliers,
    ])->layout('layout.customer');
}
    
}