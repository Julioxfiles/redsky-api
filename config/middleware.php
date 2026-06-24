<?php

use RedSky\Api\Middleware\AuthMiddleware;
use RedSky\Api\Middleware\JsonMiddleware;

return [
    'auth' => AuthMiddleware::class,
    'json' => JsonMiddleware::class,
];