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

                // 'name' => [
                //     'required',
                //     'string',
                //     'max:20', // Increased slightly as special chars take space
                //     'min:6',
                //     "regex:/^[a-zA-Z0-9?/'\s-]+$/" // Allows alphanumeric plus ? / ' space and -
                // ],
                'name' => 'required|alpha_dash|max:12|min:6',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => 'required|confirmed',
                'phone' => 'required|numeric|digits:11',
                // CRITICAL: Validate that the role is one of your allowed types
                'role' => ['required', 'string', 'in:customer,supplier,rider'],
            ], [
                // Your existing message
                'password.confirmed' => 'Password and confirm password do not match',

                // Adding more for a better UX
                'name.alpha_dash' => 'Usernames can only contain letters, numbers, dashes, and underscores.',
                'name.min' => 'Your username must be at least 6 characters.',
                'email.unique' => 'This email is already registered.',
                'phone.digits' => 'Please enter a valid 11-digit mobile number.',
                'role.required' => 'Please select whether you are a Customer, Supplier, or Rider.',
            ])->validate();

            $user = User::create([
                'username' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => Hash::make($input['password']),
            ]);

            // Securely assign the validated role using Spatie
            $user->assignRole($input['role']);

            return $user;
        }
    }
