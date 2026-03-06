<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favourite;

class FavouritesPanel extends Component
{
    public bool $open = false;

    protected $listeners = [
        'openFavourites' => 'openPanel',
    ];

    public function openPanel(): void
    {
        $this->open = true;
    }

    public function removeFavourite(int $supplierId): void
    {
        Favourite::where('user_id', auth()->id())
            ->where('supplier_id', $supplierId)
            ->delete();

        $this->dispatch('show-toast', message: 'Removed from favourites', type: 'error');
    }

    public function render()
    {
        $favourites = auth()->check()
            ? Favourite::with('supplier')
                ->where('user_id', auth()->id())
                ->latest()
                ->get()
            : collect();

        return view('livewire.favourites-panel', compact('favourites'));
    }
}