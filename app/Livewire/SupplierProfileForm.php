<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SupplierProfileForm extends Component
{
    use WithFileUploads;

    public $business_name, $business_type, $contact_phone, $address, $license_proof;

    public function save()
    {
        $this->validate([
            'business_name' => 'required',
            'business_type' => 'required',
            'contact_phone' => 'required',
            'address' => 'required',
            'license_proof' => 'image|max:2048', 
        ]);

        $path = $this->license_proof->store('verifications', 'public');

        \App\Models\SupplierProfile::create([
            'user_id' => Auth::id(),
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'contact_phone' => $this->contact_phone,
            'address' => $this->address,
            'license_proof' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('supplier.dashboard');
    }

    public function render() {
        return view('livewire.supplier-profile-form');
    }
}