<?php

namespace App\Livewire;

use Livewire\Component;

class BusinessTypeFilter extends Component
{
    public $selectedType = '';

    public function setType($type)
    {
        $this->selectedType = $type;
        
        // This triggers the #[On('filter-by-type')] in your Dashboard
        $this->dispatch('filter-by-type', type: $type);
    }

    public function render()
    {
        return view('livewire.business-type-filter');
    }
}