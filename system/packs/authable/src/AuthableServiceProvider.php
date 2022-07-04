<?php

namespace Hotash\Authable;

use Hotash\Authable\Facades\Authable;
use Hotash\Authable\Middleware\DetectGuard;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class AuthableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->singleton(Authable::class, Service::class);
        $this->app->make(Kernel::class)->pushMiddleware(DetectGuard::class);
        Jetstream::$inertiaManager = new InertiaManager();
    }

    public static function authenticateUsing(Request $request)
    {
        $user = Authable::model()::where('email', $request->email)->first();

        if ($user &&
            Hash::check($request->password, $user->password)) {
            return $user;
        }
    }

    public static function loginView()
    {
        return Inertia::render(Authable::viewSpace().'Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public static function requestPasswordResetLinkView()
    {
        abort_unless(Features::enabled(Features::resetPasswords()), 404);
        return Inertia::render(Authable::viewSpace().'Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    public static function resetPasswordView(Request $request)
    {
        abort_unless(Features::enabled(Features::resetPasswords()), 404);
        return Inertia::render(Authable::viewSpace().'Auth/ResetPassword', [
            'email' => $request->input('email'),
            'token' => $request->route('token'),
        ]);
    }

    public static function registerView()
    {
        abort_unless(Features::enabled(Features::registration()), 404);
        return Inertia::render(Authable::viewSpace().'Auth/Register');
    }

    public static function verifyEmailView()
    {
        abort_unless(Features::enabled(Features::emailVerification()), 404);
        return Inertia::render(Authable::viewSpace().'Auth/VerifyEmail', [
            'status' => session('status'),
        ]);
    }

    public static function twoFactorChallengeView()
    {
        abort_unless(Features::enabled(Features::twoFactorAuthentication()), 404);
        return Inertia::render(Authable::viewSpace().'Auth/TwoFactorChallenge');
    }

    public static function confirmPasswordView()
    {
        return Inertia::render(Authable::viewSpace().'Auth/ConfirmPassword');
    }

    public static function registerFortifyCallbacks()
    {
        Fortify::authenticateUsing([static::class, 'authenticateUsing']);
        Fortify::loginView([static::class, 'loginView']);
        Fortify::requestPasswordResetLinkView([static::class, 'requestPasswordResetLinkView']);
        Fortify::resetPasswordView([static::class, 'resetPasswordView']);
        Fortify::registerView([static::class, 'registerView']);
        Fortify::verifyEmailView([static::class, 'verifyEmailView']);
        Fortify::twoFactorChallengeView([static::class, 'twoFactorChallengeView']);
        Fortify::confirmPasswordView([static::class, 'confirmPasswordView']);
    }
}
