<?php

namespace App\Livewire;

use App\Models\FoodItem;
use App\Models\Supplier;
use Livewire\Component;

class RestaurantProfile extends Component
{
    public $supplier;

    // Change $supplier_id to $id to match your route parameter
    public function mount($id) 
    {
        $this->supplier = Supplier::findOrFail($id);
    }

    // In RestaurantProfile.php
public function render()
{
    // Fetch unique categories belonging to this specific supplier
    $categories = FoodItem::where('supplier_id', $this->supplier->id)
        ->where('status', 'available')
        ->distinct()
        ->pluck('category');

    return view('livewire.restaurant-profile', [
        'categories' => $categories
    ])->layout('layout.customer');
}
}



