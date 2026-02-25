<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FoodItem;
use App\Models\Supplier;
use App\Models\SupplierProfile;
use Illuminate\Support\Facades\Auth;

class AddFoodItem extends Component
{
    public $item_name, $original_price, $discounted_price, $quantity, $expiry_date;

    public function submit()
    {
        $this->validate([
            'item_name' => 'required|min:3',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric|lt:original_price',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'required|after:now',
        ]);

        // 1. Fetch the profile from the 'suppliers' table belonging to this user
        $supplier = Supplier::where('user_id', Auth::id())->first();

        // 2. Critical Check: Does the record exist?
        if (!$supplier) {
            session()->flash('error', 'Critical Error: No supplier record found in the "suppliers" table for User ID: ' . Auth::id());
            return;
        }

        try {
            // 3. Insert using the Supplier's ID
            FoodItem::create([
                'supplier_id'      => $supplier->id, 
                'item_name'        => $this->item_name,
                'original_price'   => $this->original_price,
                'discounted_price' => $this->discounted_price,
                'quantity'         => $this->quantity,
                'expiry_date'      => $this->expiry_date,
                'status'           => 'available',
            ]);

            $this->reset(['item_name', 'original_price', 'discounted_price', 'quantity', 'expiry_date']);

            $this->dispatch('close-modal'); 
            $this->dispatch('item-added'); 

            session()->flash('message', 'Item listed successfully!');

        } catch (\Exception $e) {
            // If the foreign key still fails, this will show us the exact ID mismatch
            session()->flash('error', 'DB Constraint Error: Tried inserting Supplier ID ' . ($supplier->id ?? 'NULL') . '. Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.add-food-item');
    }
}