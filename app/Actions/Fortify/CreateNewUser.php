<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

   public function create(array $input): User
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'password' => 'required',
        'phone' => ['required', 'string', 'max:20'],
        
        // CRITICAL: Validate that the role is one of your allowed types
        'role' => ['required', 'string', 'in:customer,supplier,rider'], 
    ])->validate();

    $user = User::create([
        'username' => $input['name'],
        'email' => $input['email'],
        'phone' => $input['phone'],
        'password' => Hash::make($input['password']),
    ]);

    // Securely assign the validated role using Spatie
    // $user->assignRole($input['role']);

    return $user;
}
}
