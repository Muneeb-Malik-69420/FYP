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
        // Counts items for the logged-in supplier
        $this->activeListings = FoodItem::where('supplier_id', Auth::user()->supplierProfile->id)->count();
    }

    public function render()
    {
        return view('livewire.supplier-stats');
    }
}