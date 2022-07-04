<?php

namespace Hotash\Authable\Facades;

use Hotash\Authable\Service;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string as()
 * @method static string guard()
 * @method static string isGuard()
 * @method static string model()
 * @method static string add(string $guard, string $model, $features = [])
 * @method static string features(string $provider = null)
 * @method static string viewSpace()
 * @method static string guardURL(string $guard = null)
 *
 * @see \Hotash\Authable\Service
 */
class Authable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Service::class;
    }
}
