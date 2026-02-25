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
            ->whereHas('city', function ($query) {
                $query->where('name', $this->selectedCity);
            })
            // 1. Filter by the specific Business Type (from the new component)
            ->when($this->businessType, function ($query) {
                $query->where('business_type', $this->businessType); 
            })
            // 2. Search by Business Name or Food Item (your existing search)
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($q) {
                    $q->where('business_name', 'like', '%' . $this->searchQuery . '%')
                      ->orWhereHas('foodItems', function ($foodQ) {
                          $foodQ->where('item_name', 'like', '%' . $this->searchQuery . '%');
                      });
                });
            })
            ->with(['foodItems' => function($q) {
                $q->where('quantity', '>', 0);
            }])
            ->get();

        return view('livewire.customer-dashboard', [
            'suppliers' => $suppliers,
        ]);
    }
}