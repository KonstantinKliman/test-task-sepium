<?php

use App\Router\Router;

spl_autoload_register(function($class) {
    $root = $_SERVER['DOCUMENT_ROOT'] . '/../';
    $ds = DIRECTORY_SEPARATOR;
    $class = str_replace('\\', $ds, $class);
    $filename = $root . $ds . $class . '.php';
    if (file_exists($filename)) {
        require($filename);
    } else {
        throw new Exception("File not found: $filename");
    }
});

$router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$router->dispatch();