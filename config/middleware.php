<?php
declare(strict_types=1);

use RedSky\Framework\Http\Middleware\AuthMiddleware;
use RedSky\Framework\Http\Middleware\JsonMiddleware;

return [
    'auth' => AuthMiddleware::class,
    'json' => JsonMiddleware::class,
];