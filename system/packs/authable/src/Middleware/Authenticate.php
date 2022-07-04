<?php

namespace Hotash\Authable\Middleware;

use Closure;
use Hotash\Authable\Facades\Authable;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($guard = Authable::guard()) {
            $guards = [...$guards, $guard];
        }

        return parent::handle($request, $next, ...$guards);
    }
}
