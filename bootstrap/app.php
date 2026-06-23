<?php

use Redsky\Framework\Container\Container;
use Redsky\Framework\Http\Kernel;
use Redsky\Framework\Http\Router;
use Redsky\Framework\Http\Request;
use Redsky\Framework\Http\Response;
use Redsky\Framework\Http\Handler;

/*
|--------------------------------------------------------------------------
| Create Application Container
|--------------------------------------------------------------------------
*/

$app = new Container();

/*
|--------------------------------------------------------------------------
| Register Core Singletons (Laravel style)
|--------------------------------------------------------------------------
*/

$app->singleton(Router::class, fn () => new Router());

$app->singleton(Handler::class, fn () => new Handler());

$app->singleton(Kernel::class, function ($app) {
    return new Kernel(
        $app,
        $app->make(Router::class),
        $app->make(Handler::class)
    );
});

/*
|--------------------------------------------------------------------------
| Load routes (IMPORTANT: after Router exists)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../routes/web.php';

/*
|--------------------------------------------------------------------------
| Return application container
|--------------------------------------------------------------------------
*/

return $app;