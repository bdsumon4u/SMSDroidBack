<?php

namespace Hotash\Authable;

use App\Models\User;
use Illuminate\Support\Str;

class Service
{
    private array $stack = [];

    public function url($path = null, $parameters = [], $secure = null): string
    {
        return $this->guardUrl($this->guard(), $path, $parameters, $secure);
    }

    public function prefixBased($guard = null, $path = null, $parameters = [], $secure = null): string
    {
        $host = parse_url(config('app.url'), PHP_URL_HOST);
        $guardHost = $host . ($guard ? '/' . $guard : null);
        if (is_null($path)) {
            return $guardHost;
        }

        $url = url($path, $parameters, $secure);
        if (! Str::startsWith($url, $guardHost)) {
            return str_replace($host, $guardHost, $url);
        }

        return $url;
    }

    public function guardUrl($guard = null, $path = null, $parameters = [], $secure = null): string
    {
        if (! false) {
            return $this->prefixBased(...func_get_args());
        }

        $host = parse_url(config('app.url'), PHP_URL_HOST);
        $guardHost = $guard . ($guard ? '.' : null) . $host;
        if (is_null($path)) {
            return $guardHost;
        }

        $url = url($path, $parameters, $secure);
        if (parse_url($url, PHP_URL_HOST) !== $guardHost) {
            return str_replace($host, $guardHost, $url);
        }

        return $url;
    }

    public function isGuard(string $guard): bool
    {
        return Str::startsWith(request()->getHost(), $guard . '.');
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->stack;
    }

    /**
     * @return array
     */
    public function guards(): array
    {
        return array_keys($this->stack);
    }

    /**
     * @param string $guard
     * @param callable $on
     * @param string $model
     * @return void
     */
    public function add(string $guard, string $model, string $provider): void
    {
        $this->stack[$guard] = compact('model', 'provider');

        # Password Provider [! Service]
        $provider = Str::plural($guard);

        config([
            'auth.guards.'.$guard => array_merge([
                'driver' => 'session',
                'provider' => $provider,
            ], config('auth.guards.'.$guard, [])),
        ]);

        config([
            'auth.providers.'.$provider => [
                'driver' => 'eloquent',
                'model' => $model,
            ],
        ]);

        config([
            'auth.passwords.'.$provider => [
                'provider' => $provider,
                'table' => 'password_resets',
                'expire' => 60,
                'throttle' => 60,
            ],
        ]);
    }

    /**
     * @return string|null
     */
    public function guard(): ?string
    {
        foreach ($this->stack as $guard => $data) {
            if ($this->isGuard($guard)) return $guard;
        }
        return null;
    }

    public function data(string $guard = null): array
    {
        return $this->stack[$guard ?? $this->guard()] ?? [];
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return $this->stack[$this->guard()]['model'] ?? User::class;
    }

    /**
     * @return string|null
     */
    public function provider(): ?string
    {
        return $this->data()['provider'] ?? null;
    }

    /**
     * @return string
     */
    public function as(): string
    {
        if ($guard = $this->guard()) {
            return $guard.'.';
        }
        return '';
    }

    /**
     * @return string
     */
    public function viewSpace(): string
    {
        if ($guard = $this->guard()) {
            return 'packs/'.$guard.'::';
        }
        return '';
    }

    public function features(string $key = null)
    {
        if ($provider = $this->provider()) {
            $features = call_user_func([$provider, 'features']);
            return $features[$key] ?? $features;
        }

        return AuthProviderTemplate::features();
    }
}
