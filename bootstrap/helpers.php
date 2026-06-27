<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Container Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('app')) {
    function app(?string $key = null): mixed
    {
        $app = \RedSky\Foundation\Application::getInstance();

        if ($key === null) {
            return $app;
        }

        return $app->container()->make($key);
    }
}

/*
|--------------------------------------------------------------------------
| Config Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('config')) {
    function config(string $key = null, mixed $default = null): mixed
    {
        $repository = app('config');

        if ($key === null) {
            return $repository;
        }

        return $repository->get($key, $default);
    }
}

/*
|--------------------------------------------------------------------------
| Env Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        return $_ENV[$key]
            ?? $_SERVER[$key]
            ?? $default;
    }
}

/*
|--------------------------------------------------------------------------
| Request Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('request')) {
    function request(): \RedSky\Http\Request
    {
        return app(\RedSky\Http\Request::class);
    }
}

/*
|--------------------------------------------------------------------------
| Response Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('response')) {
    function response(): \RedSky\Http\Response
    {
        return app(\RedSky\Http\Response::class);
    }
}

/*
|--------------------------------------------------------------------------
| Redirect Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('redirect')) {
    function redirect(string $to): \RedSky\Http\Response
    {
        return response()->redirect($to);
    }
}

/*
|--------------------------------------------------------------------------
| Auth Helper
|--------------------------------------------------------------------------
*/

if (!function_exists('auth')) {
    function auth(): \RedSky\Security\Auth\Auth
    {
        return app(\RedSky\Security\Auth\Auth::class);
    }
}

/*
|--------------------------------------------------------------------------
| URL Helper (simple base)
|--------------------------------------------------------------------------
*/

if (!function_exists('url')) {
    function url(string $path = ''): string
    {
        $base = rtrim(env('APP_URL', 'http://localhost'), '/');

        return $base . '/' . ltrim($path, '/');
    }
}

/*
|--------------------------------------------------------------------------
| Old Input Helper (for forms later)
|--------------------------------------------------------------------------
*/

if (!function_exists('old')) {
    function old(string $key, mixed $default = null): mixed
    {
        return $_SESSION['_old'][$key] ?? $default;
    }
}

/*
|--------------------------------------------------------------------------
| CSRF Helper (placeholder for future middleware integration)
|--------------------------------------------------------------------------
*/

if (!function_exists('csrf_token')) {
    function csrf_token(): ?string
    {
        return $_SESSION['_csrf'] ?? null;
    }
}