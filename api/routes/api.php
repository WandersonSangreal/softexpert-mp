<?php

use App\Helper\Route;
use App\Controllers\ProductController;

$uri = preg_replace("/[^a-zA-Z0-9-\/]/", "", $_SERVER["REQUEST_URI"]);
$method = $_SERVER["REQUEST_METHOD"];

$routes = [
	'/product' => ProductController::class
];

if (in_array($uri, array_keys($routes))) {

	Route::$method($uri, $routes[$uri]);

}
