<?php

declare(strict_types=1);

use RedSky\Framework\Routing\Router;
use RedSky\Framework\Routing\Route;
use RedSky\Framework\Database\Connection\Connection;
use RedSky\Framework\Database\Model;
use RedSky\Framework\Config\Repository;
use RedSky\Framework\Support\Env;

/*
|--------------------------------------------------------------------------
| Carga el archivo .env
|--------------------------------------------------------------------------
*/


Env::load(dirname(__DIR__) . '/.env');

/*
|--------------------------------------------------------------------------
| Bootstrap: Application Container
|--------------------------------------------------------------------------
*/

$app = new \RedSky\Framework\Foundation\Application();

$container = $app->container();

/*
|--------------------------------------------------------------------------
| Register Router (single instance)
|--------------------------------------------------------------------------
*/

$router = new Router();

$container->singleton(
    Router::class,
    fn () => $router
);

Route::setRouter($router);

/*
|--------------------------------------------------------------------------
| Load Configuration Files (raw array)
|--------------------------------------------------------------------------
*/

$config = [];

foreach (glob(__DIR__ . '/../config/*.php') as $file) {
    $key = basename($file, '.php');

    $value = require $file;

    if (!is_array($value)) {
        die("CONFIG ERROR in: $file");
    }

    $config[$key] = $value;
}

/*
|--------------------------------------------------------------------------
| Register Config Repository into Container
|--------------------------------------------------------------------------
*/

$container->singleton('config', function () use ($config) {
    return new Repository($config);
});

/*
|--------------------------------------------------------------------------
| Boot Database Layer
|--------------------------------------------------------------------------
| IMPORTANT: env() must already be available here
| so DB config can resolve correctly
|--------------------------------------------------------------------------
*/

Connection::configure(
    $config['database'] ?? []
);

Model::setConnection(Connection::get());
Model::setGrammar(Connection::grammar());

/*
|--------------------------------------------------------------------------
| Load Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../routes/web.php';

/*
|--------------------------------------------------------------------------
| Return Application
|--------------------------------------------------------------------------
*/

return $app;