<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use Livewire\Attributes\Session;

class CustomerSearch extends Component
{
    #[Session(key: 'user_city')] 
    public $city = 'Jhelum'; // This stores the Name for the UI
    
    public $searchQuery = '';

    public function mount()
    {
        $this->city = session('user_city', 'Jhelum');
    }

    public function selectCity($cityName)
    {
        // 1. Update the property
        $this->city = $cityName;
        
        // 2. Sync to Session (so it survives page refreshes)
        session(['user_city' => $cityName]);

        // 3. Tell other components to refresh their food lists
        $this->dispatch('filtersUpdated', [
            'city' => $this->city,
            'search' => $this->searchQuery
        ]);
    }

    public function updatedSearchQuery()
    {
        $this->dispatch('filtersUpdated', [
            'city' => $this->city,
            'search' => $this->searchQuery
        ]);
    }

    public function render()
    {
        return view('livewire.customer-search', [
            // We fetch cities that have an 'approved' profile in your supplier_profiles table
            'activeCities' => City::whereHas('suppliers', function ($query) {
                $query->where('status', 'approved');
            })->orderBy('name', 'asc')->get()
        ]);
    }
}