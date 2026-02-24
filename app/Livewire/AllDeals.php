<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;
use App\Models\SurplusItem;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class AllDeals extends Component
{
    use WithPagination;

    public $selectedCity;
    public $searchQuery = '';

    public function boot()
    {
        $this->selectedCity = session('user_city', 'Jhelum');
    }

    #[On('filtersUpdated')]
    public function updateFilters($data)
    {
        // Handling both array and direct string formats for safety
        $this->selectedCity = is_array($data) ? ($data['city'] ?? $this->selectedCity) : $data;
        $this->searchQuery = is_array($data) ? ($data['search'] ?? '') : '';
        $this->resetPage();
    }

    public function render()
    {
        $deals = FoodItem::whereHas('supplier.city', function ($q) {
                $q->where('name', $this->selectedCity);
            })
            ->when($this->searchQuery, function ($q) {
                $q->where('item_name', 'like', '%' . $this->searchQuery . '%');
            })
            ->with('supplier')
            ->latest()
            ->paginate(12);

        return view('livewire.all-deals', [
            'deals' => $deals
        ])->layout('layout.customer');
    }
}