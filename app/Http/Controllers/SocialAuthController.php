<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
{
    try {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            $user->update([
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        } else {
            $user = User::create([
                'username'    => $socialUser->getName() ?? $socialUser->getNickname(),
                'email'       => $socialUser->getEmail(),
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'password'    => bcrypt(Str::random(24)),
            ]);

            // ✅ Assign default role ONLY for new users
            $user->assignRole('customer');
        }

        Auth::login($user);

        // 🔁 Let /dashboard decide where to go
        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Social login failed.');
    }
}
}