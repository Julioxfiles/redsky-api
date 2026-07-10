<?php

use RedSky\Framework\Routing\Route;
use RedSky\Framework\Http\Response;
use App\Http\Controllers\EBibleController;

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

Route::get('/prueba123456', function () {
    return 'FUNCIONA';
});

Route::get('/ebible/{book}/{chapter}', [EBibleController::class, 'show']);