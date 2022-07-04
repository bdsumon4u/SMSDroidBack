<?php

namespace Hotash\Authable\Middleware;

use Closure;
use Hotash\Authable\Facades\Authable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DetectGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($guard = Authable::guard()) {
            config(['fortify.guard' => $guard]);
            config(['fortify.prefix' => $guard]);
            config(['jetstream.guard' => $guard]);
            config(['jetstream.prefix' => $guard]);
            config(['fortify.passwords' => Str::plural($guard)]);
            config(['fortify.features' => Authable::features('fortify')]);
            config(['jetstream.features' => Authable::features('jetstream')]);
        }

        return $next($request);
    }
}
