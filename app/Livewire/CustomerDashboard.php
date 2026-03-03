<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Supplier;

class CustomerDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $selectedCity;
    public $searchQuery = '';
    public $businessType = '';

    public function mount()
    {
        $this->selectedCity = session('user_city', 'Jhelum');
    }

    /*
    |--------------------------------------------------------------------------
    | Event Listeners
    |--------------------------------------------------------------------------
    */

    #[On('filtersUpdated')]
    public function updateFilters($data)
    {
        $this->selectedCity = $data['city'] ?? $this->selectedCity;
        $this->searchQuery = $data['search'] ?? $this->searchQuery;

        $this->resetPage();
    }

    #[On('filter-by-type')]
    public function updateBusinessType($type)
    {
        $this->businessType = $type;
        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Computed Property (Cleaner Query Logic)
    |--------------------------------------------------------------------------
    */

    public function getSuppliersProperty()
    {
        return Supplier::query()
            ->where('status', 'approved')

            // Must have active food items
            ->whereHas('foodItems', fn ($q) =>
                $q->where('quantity', '>', 0)
            )

            // Filter by city
            ->whereHas('city', fn ($q) =>
                $q->where('name', $this->selectedCity)
            )

            // Filter by business type
            ->when($this->businessType, fn ($q) =>
                $q->where('business_type', $this->businessType)
            )

            // Search filter
            ->when($this->searchQuery, function ($q) {
                $q->where(function ($subQuery) {
                    $subQuery
                        ->where('business_name', 'like', "%{$this->searchQuery}%")
                        ->orWhereHas('foodItems', fn ($foodQ) =>
                            $foodQ->where('item_name', 'like', "%{$this->searchQuery}%")
                                  ->where('quantity', '>', 0)
                        );
                });
            })

            // Eager load only active food items
            ->with(['foodItems' => fn ($q) =>
                $q->where('quantity', '>', 0)
            ])

            ->paginate(12); // 🔥 Change number per page as needed
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return view('livewire.customer-dashboard', [
            'suppliers' => $this->suppliers,
        ])->layout('layout.customer');
    }
}