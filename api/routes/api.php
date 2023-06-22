<?php

use App\Controllers\SaleController;
use App\Controllers\TaxController;
use App\Controllers\TypeController;
use App\Helper\Route;
use App\Controllers\ProductController;

$uri = preg_replace("/[^a-zA-Z0-9-\/]/", "", $_SERVER["REQUEST_URI"]);
$method = $_SERVER["REQUEST_METHOD"];

$routes = [
	'/product' => ProductController::class,
	'/product/{id}' => ProductController::class,
	'/type' => TypeController::class,
	'/type/{id}' => TypeController::class,
	'/tax' => TaxController::class,
	'/tax/{id}' => TaxController::class,
	'/sale' => SaleController::class,
	'/sale/{id}' => SaleController::class,
];

header('Content-Type: application/json; charset=utf-8');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$params = [];

if (in_array($uri, array_keys($routes))) {

	$match = [$uri];

} else {

	$filtered = array_values(array_filter(array_keys($routes), fn($item) => preg_match('/[\}\{]/', $item)));

	$match = array_values(array_filter($filtered, function ($item) use ($uri, &$params) {

		$parts = array_filter(explode('/', $uri));
		$routes = array_filter(explode('/', $item));

		$marks = array_diff($routes, $parts);
		$queryparams = array_diff($parts, $routes);

		$found = sizeof($marks) === sizeof($queryparams) && sizeof(array_intersect($routes, $parts)) > 0;

		if ($found) {
			$params = $queryparams;
		}

		return $found;

	}));

}

if (!empty($match)) {

	foreach ($params as $param) {
		$uri = str_replace('/' . $param, '', $uri);
	}

	Route::$method($routes[$uri], null, ...array_values($params));

} else {

	Route::notFound();

}
