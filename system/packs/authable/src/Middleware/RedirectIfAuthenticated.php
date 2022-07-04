<?php

namespace Hotash\Authable\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Hotash\Authable\Facades\Authable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        if ($guard = Authable::guard()) {
            $guards = [...$guards, $guard];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request, Authable::as()));
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $as
     * @return string|null
     */
    protected function redirectTo($request, $as)
    {
        return RouteServiceProvider::HOME;
    }
}
