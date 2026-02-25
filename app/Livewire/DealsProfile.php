<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;

class DealsProfile extends Component
{
    public $supplierId;

    // Use mount to capture the ID from the URL/Route
    public function mount($id = null)
    {
        $this->supplierId = $id;
    }

    public function render()
    {
        // If you have a specific supplier ID, filter by it. 
        // Otherwise, show all available items for testing.
        $query = FoodItem::where('status', 'available');

        if ($this->supplierId) {
            $query->where('supplier_id', $this->supplierId);
        }

        $foodItems = $query->get();

        return view('livewire.deals-profile', [
            'foodItems' => $foodItems
        ]);
    }
}