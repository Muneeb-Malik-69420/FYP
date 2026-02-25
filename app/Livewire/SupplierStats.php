<?php 

namespace App\Livewire;

use App\Models\FoodItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SupplierStats extends Component
{
    public $activeListings = 0;

    public function mount()
    {
        $this->refreshStats();
    }

    #[On('item-added')] 
    public function refreshStats()
    {
        $user = Auth::user();

        // 1. Safety check: Does the user even have a supplier record?
        if ($user && $user->supplier) {
            $this->activeListings = FoodItem::where('supplier_id', $user->supplier->id)->count();
        } else {
            $this->activeListings = 0;
        }
    }

    public function render()
    {
        return view('livewire.supplier-stats');
    }
}