<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            // Use stateless() to avoid the "InvalidStateException" we saw earlier
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // 1. Find or create the user by email
            // We use firstOrCreate so we don't overwrite existing data (like passwords)
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // 2. If user exists, just update social provider info if needed
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            } else {
                // 3. If user is brand new, create them
                $user = User::create([
                    'username'    => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email'       => $socialUser->getEmail(),
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'password'    => bcrypt(Str::random(24)),
                ]);
            }

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Exception $e) {
            // Log the error and send them back to login
            return redirect('/login')->with('error', 'Something went wrong with Google sign-in.');
        }
    }
}