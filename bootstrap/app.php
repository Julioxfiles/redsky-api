<?php

use Redsky\Framework\Container\Container;
use Redsky\Framework\Http\Kernel;

/**
 * 1. Crear Container base
 */
$container = new Container();

/**
 * 2. Registrar el Kernel dentro del container
 */
$container->singleton(Kernel::class, function ($container) {
    return new Kernel($container);
});

/**
 * 3. Retornar container como punto de entrada de la app
 */
return $container;