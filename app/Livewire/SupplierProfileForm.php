<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SupplierProfileForm extends Component
{
    use WithFileUploads;

    public $business_name, $business_type, $contact_phone, $address, $license_proof;
    public $city_id; // Added to store the selected city

    protected $rules = [
        'business_name' => 'required|min:3',
        'business_type' => 'required',
        'contact_phone' => 'required',
        'city_id' => 'required|exists:cities,id',
        'address' => 'required',
        'license_proof' => 'required|image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->license_proof->store('licenses', 'public');

        Supplier::create([
            'user_id' => Auth::id(),
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'city_id' => $this->city_id, // Links to your cities table
            'business_location' => $this->address,
            'license_document' => $path,
            'is_verified' => false, // Approval toggle
        ]);

        return redirect()->route('supplier.dashboard');
    }

    public function render()
    {
        return view('livewire.supplier-profile-form', [
            'cities' => City::orderBy('name', 'asc')->get()
        ]);
    }
}