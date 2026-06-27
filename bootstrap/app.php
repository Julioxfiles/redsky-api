<?php

declare(strict_types=1);

use RedSky\Foundation\Application;
use RedSky\Routing\Router;
use RedSky\Routing\Route;
use RedSky\Config\Repository;
use RedSky\Support\Env;
use RedSky\Database\Connection\Connection;
use RedSky\Database\Model;

/*
|--------------------------------------------------------------------------
| Load .env
|--------------------------------------------------------------------------
*/

Env::load(dirname(__DIR__) . '/.env');

/*
|--------------------------------------------------------------------------
| Create Application
|--------------------------------------------------------------------------
*/

$app = new Application();
$container = $app->container();

/*
|--------------------------------------------------------------------------
| SINGLE ROUTER (ONLY ONE INSTANCE)
|--------------------------------------------------------------------------
*/

$router = new Router();

$container->instance(Router::class, $router);

Route::setRouter($router);

/*
|--------------------------------------------------------------------------
| Config
|--------------------------------------------------------------------------
*/

$config = [];

foreach (glob(__DIR__ . '/../config/*.php') as $file) {
    $key = basename($file, '.php');
    $value = require $file;

    if (!is_array($value)) {
        throw new RuntimeException("Invalid config file: {$file}");
    }

    $config[$key] = $value;
}

$container->singleton('config', fn () => new Repository($config));

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
*/

Connection::configure($config['database'] ?? []);

Model::setConnection(Connection::get());
Model::setGrammar(Connection::grammar());

/*
|--------------------------------------------------------------------------
| Routes (must use SAME router instance)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../routes/api.php';

/*
|--------------------------------------------------------------------------
| Return app
|--------------------------------------------------------------------------
*/

return $app;