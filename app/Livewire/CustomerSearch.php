<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;

class CustomerSearch extends Component
{
    public $city;
    public $searchQuery = '';

    public function mount()
    {
        // Default to Session value OR Jhelum if empty
        $this->city = session('user_city',);
    }

    public function selectCity($cityName)
    {
        // 1. Set the session
        session(['user_city' => $cityName]);

        // 2. Instead of a silent dispatch, redirect to the same page
        // This clears any "stuck" state and forces Jhelum to disappear
        return redirect(request()->header('Referer'));
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
            'activeCities' => City::whereHas('suppliers', function ($query) {
                $query->where('status', 'approved');
            })->orderBy('name', 'asc')->get()
        ]);
    }
}
