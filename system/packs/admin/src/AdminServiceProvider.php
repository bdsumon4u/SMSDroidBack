<?php

namespace Hotash\Admin;

use Hotash\Admin\Models\Admin;
use Hotash\Authable\AuthProviderTemplate;

class AdminServiceProvider extends AuthProviderTemplate
{
    protected string $DIR = __DIR__;
    protected string $guard = 'admin';
    protected string $model = Admin::class;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    public static function features(): array
    {
        return [
            'fortify' => [
                \Laravel\Fortify\Features::registration(),
                \Laravel\Fortify\Features::resetPasswords(),
                \Laravel\Fortify\Features::emailVerification(),
                \Laravel\Fortify\Features::updateProfileInformation(),
                \Laravel\Fortify\Features::updatePasswords(),
                \Laravel\Fortify\Features::twoFactorAuthentication([
                    'confirm' => true,
                    'confirmPassword' => true,
                    // 'window' => 0,
                ]),
            ],
            'jetstream' => [
                \Laravel\Jetstream\Features::termsAndPrivacyPolicy(),
                \Laravel\Jetstream\Features::profilePhotos(),
                \Laravel\Jetstream\Features::api(),
                // \Laravel\Jetstream\Features::teams(['invitations' => true]),
                \Laravel\Jetstream\Features::accountDeletion(),
            ],
        ];
    }
}
