<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;

class CustomerSearch extends Component
{
    public $city;
    public $searchQuery = '';

    /**
     * Mount the component and initialize the city state.
     */
    public function mount()
    {
        // 1. Check if a city is already saved in the session.
        // 2. If not, default to 'Jhelum' (or any preferred default).
        $this->city = session('user_city', 'Jhelum');
    }

    /**
     * Update the selected city and refresh the page state.
     */
    public function selectCity($cityName)
    {
        // 1. Save the new city selection to the session for persistence across redirects.
        session(['user_city' => $cityName]);

        // 2. Update the local component property immediately.
        $this->city = $cityName;

        // 3. Redirect to the referring page. 
        // This clears the component state and ensures the mount() method 
        // runs again to pick up the new session value.
        return redirect(request()->header('Referer'));
    }

    /**
     * Handle real-time search query updates.
     */
    public function updatedSearchQuery()
    {
        // Dispatch an event to other components (like StoreList) 
        // so they can filter results based on the city and search string.
        $this->dispatch('filtersUpdated', [
            'city' => $this->city,
            'search' => $this->searchQuery
        ]);
    }

    public function render()
    {
        return view('livewire.customer-search', [
            // Only fetch cities that have approved suppliers to avoid empty results.
            'activeCities' => City::whereHas('suppliers', function ($query) {
                $query->where('status', 'approved');
            })->orderBy('name', 'asc')->get()
        ]);
    }
}