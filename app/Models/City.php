<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function suppliers()
{
    return $this->hasMany(Supplier::class);
}
public function supplierProfiles()
{
    return $this->hasMany(SupplierProfile::class); // Assuming this is your profile model name
}
}
