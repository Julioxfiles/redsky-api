<?php

use RedSky\Framework\Foundation\Application;
use RedSky\Framework\Routing\Router;
use RedSky\Framework\Routing\Route;

use RedSky\Framework\Database\Connection\Connection;
use RedSky\Framework\Database\Model;

/*
|--------------------------------------------------------------------------
| Create Application
|--------------------------------------------------------------------------
*/

$app = new Application();

/*
|--------------------------------------------------------------------------
| Resolve Container
|--------------------------------------------------------------------------
*/

$container = $app->container();

/*
|--------------------------------------------------------------------------
| Create SINGLE Router instance
|--------------------------------------------------------------------------
*/

$router = new Router();

/*
|--------------------------------------------------------------------------
| Register Router into Container
|--------------------------------------------------------------------------
*/

$container->singleton(
    Router::class,
    fn () => $router
);

/*
|--------------------------------------------------------------------------
| Bind Route Facade to SAME Router instance
|--------------------------------------------------------------------------
*/

Route::setRouter($router);

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION + BOOT
|--------------------------------------------------------------------------
*/

Connection::configure([
    'default' => [
        'driver'   => 'mysql',
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'database' => 'lancaster',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8mb4',
    ],
]);

// 🔥 IMPORTANT: initialize Model with framework connection
Model::setConnection(Connection::get());
Model::setGrammar(Connection::grammar());

/*
|--------------------------------------------------------------------------
| Load application routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../routes/web.php';

/*
|--------------------------------------------------------------------------
| Return Application
|--------------------------------------------------------------------------
*/

return $app;