<?php

namespace App\Livewire;

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

    public function render()
    {
        return view('livewire.restaurant-profile')->layout('layout.customer');
    }
}