<?php

use RedSky\Framework\Routing\Route;
use RedSky\Framework\Http\Response;
use RedSky\Api\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Response::json([
        'message' => 'Home working'
    ]);
});

Route::get('/test', function () {
    return Response::json([
        'message' => 'Test route working'
    ]);
});

/*
Route::get('/users', function () {
    return Response::json([
        'data' => [
            ['id' => 1, 'name' => 'Julio'],
            ['id' => 2, 'name' => 'Ana'],
        ]
    ]);
});
*/

Route::get('/users', [UserController::class, 'index']);