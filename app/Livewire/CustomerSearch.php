<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use Livewire\Attributes\Session;

class CustomerSearch extends Component
{
    #[Session(key: 'user_city')] 
    public $city = 'Jhelum';
    
    public $searchQuery = '';

    public function mount()
    {
        $this->city = session('user_city', 'Jhelum');
    }

    public function selectCity($cityName)
{
    // 1. Update the local property
    $this->city = $cityName;
    
    // 2. Force update the session (important for cross-page persistence)
    session(['user_city' => $cityName]);

    // 3. Notify other components (Deals, Restaurants)
    $this->dispatchFilterUpdate();
    
    // 4. Optional: Log to check if it's hitting the method
    // \Log::info("City selected: " . $cityName);
}

    public function updatedSearchQuery()
    {
        $this->dispatchFilterUpdate();
    }

    private function dispatchFilterUpdate()
    {
        $this->dispatch('filtersUpdated', [
            'city' => $this->city,
            'search' => $this->searchQuery
        ]);
    }

    public function render()
    {
        return view('livewire.customer-search', [
            /* IMPORTANT: 
               1. Changed 'Suppliers' to 'suppliers' (lower case)
               2. Ensure your City model has the 'suppliers' or 'supplierProfiles' relationship
            */
            'activeCities' => City::whereHas('suppliers', function ($query) {
                $query->where('status', 'approved');
            })->orderBy('name', 'asc')->get()
        ]);
    }
}