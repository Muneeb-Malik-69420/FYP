<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use Livewire\Attributes\Session;

class CustomerSearch extends Component
{
    #[Session] public $city = 'Jhelum';
    public $searchQuery = '';

    public function mount()
    {
        // Set default city from session or use Jhelum
        $this->city = session('user_city', 'Jhelum');
    }

    public function selectCity($cityName)
    {
        $this->city = $cityName;
        // This automatically saves to session because of the #[Session] attribute
        $this->dispatch('filtersUpdated', city: $cityName);
    }

    public function updatedSearchQuery()
    {
        $this->dispatchFilterUpdate();
    }

    private function dispatchFilterUpdate()
    {
        // Dispatches to your dashboard to filter by City and Search Query
        $this->dispatch('filtersUpdated', [
            'city' => $this->city,
            'search' => $this->searchQuery
        ]);
    }

    public function render()
    {
        return view('livewire.customer-search', [
            // Only displays cities where verified suppliers exist
            'cities' => City::whereHas('suppliers', function ($query) {
                $query->where('is_verified', true);
            })->get()
        ]);
    }
}
