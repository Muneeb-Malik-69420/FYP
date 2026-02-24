<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;

class AllRestaurants extends Component
{
    public $selectedCity;
    public $searchQuery = '';

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

    public function render()
    {
        $restaurants = Supplier::whereHas('city', function ($q) {
                $q->where('name', $this->selectedCity);
            })
            ->where('is_verified', true)
            ->when($this->searchQuery, function ($q) {
                $q->where('business_name', 'like', '%' . $this->searchQuery . '%');
            })
            ->get();

        return view('livewire.all-restaurants', [
            'restaurants' => $restaurants
        ])->layout('layout.customer');
    }
}
