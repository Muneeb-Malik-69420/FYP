<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        // 1. Register View: Where users pick their role and sign up
    Fortify::registerView(function () {
        return view('auth.register');
    });

    // 2. Login View: Your custom login page
    Fortify::loginView(function () {
        return view('auth.login');
    });

    // 3. Forgot Password View
    Fortify::requestPasswordResetLinkView(function () {
        return view('auth.forgot-password');
    });

    // 4. Reset Password View
    Fortify::resetPasswordView(function ($request) {
        return view('auth.reset-password', ['request' => $request]);
    });

    // 5. 2FA Challenge View: Shown after login if 2FA is enabled
    Fortify::twoFactorChallengeView(function () {
        return view('auth.two-factor-challenge');
    });

    // Register the Password Confirmation View
    Fortify::confirmPasswordView(function () {
        return view('auth.confirm-password');
    });

    // Rate Limiters...
    RateLimiter::for('login', function (Request $request) {
        // ... existing logic ...
    });
    }
}
