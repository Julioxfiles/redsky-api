<?php
declare(strict_types=1);

use RedSky\Http\Middleware\AuthMiddleware;
use RedSky\Http\Middleware\JsonMiddleware;

return [
    'auth' => AuthMiddleware::class,
    'json' => JsonMiddleware::class,
];