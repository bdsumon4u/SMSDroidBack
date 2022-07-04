<?php

namespace Hotash\Authable;

use Hotash\Authable\Facades\Authable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthProviderTemplate extends ServiceProvider
{
    protected string $DIR;
    protected string $guard;
    protected string $model;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Authable::add($this->guard, $this->model, static::class);

        if (! app()->configurationIsCached()) {
            if (file_exists($path = $this->DIR.'/../config/'.$this->guard.'.php')) {
                $this->mergeConfigFrom($path, $this->guard);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                $this->DIR.'/../database/migrations' => database_path('migrations'),
            ], $this->guard.'-migrations');

            $this->publishes([
                $this->DIR.'/../config/'.$this->guard.'.php' => config_path($this->guard.'.php'),
            ], $this->guard.'-config');
        }

        $this->loadMigrationsFrom($this->DIR.'/../database/migrations');

        foreach (File::glob($this->DIR.'/../routes/*.php') as $file) {
            $this->loadRoutesFrom($file);
        }

        if (File::isFile($path = base_path('routes/'.$this->guard.'.php'))) {
            Route::domain(Authable::guardURL($this->guard))
                ->as($this->guard.'.')
                ->middleware(['web'])
                ->group(function () use ($path) {
                    $this->loadRoutesFrom($path);
                });
        }
    }

    public static function features(): array
    {
        return [
            'fortify' => config('fortify.features'),
            'jetstream' => config('jetstream.features'),
        ];
    }
}
