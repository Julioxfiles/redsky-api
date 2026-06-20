<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * 1. Bootstrapping de la aplicación
 */
$container = require __DIR__ . '/../bootstrap/app.php';

/**
 * 2. Resolver Kernel desde el container
 */
$kernel = $container->make(\Redsky\Framework\Http\Kernel::class);

/**
 * 3. Request temporal (después será clase Request real)
 */
$request = $_SERVER;

/**
 * 4. Ejecutar Kernel
 */
$response = $kernel->handle($request);

/**
 * 5. Output
 */
echo "<pre>";
var_dump($response);