<?php

namespace App\Livewire;

use Livewire\Component;

class RestaurantProfile extends Component
{
    public function render()
    {
        return view('livewire.restaurant-profile')->layout('layout.customer');
    }
}
