<?php

namespace App\Helper;

class Route
{
	private static array $resources = ['get' => 'show', 'post' => 'store', 'put' => 'update', 'delete' => 'destroy'];

	private static function runMethod($controller, $action, ...$params)
	{
		$instance = new $controller();

		return $instance->$action(...$params);

	}

	public static function get($controller, $action = null, ...$params)
	{
		$action = $action ?? self::$resources['get'];

		echo Route::runMethod($controller, $action, ...$params);
	}

	public static function post($controller, $action = null, ...$params)
	{
		$action = $action ?? self::$resources['post'];

		echo Route::runMethod($controller, $action, ...$params);
	}

	public static function put($controller, $action = null, ...$params)
	{
		$action = $action ?? self::$resources['put'];

		echo Route::runMethod($controller, ($action ?? 'update'), ...$params);
	}

	public static function delete($controller, $action = null, ...$params)
	{
		$action = $action ?? self::$resources['delete'];

		echo Route::runMethod($controller, ($action ?? 'destroy'), ...$params);
	}

	public static function notFound()
	{
		header($_SERVER["SERVER_PROTOCOL"] . "/1.0 404 Not Found", true, 404);

		echo json_encode(['status' => 'error', 'message' => '404 - page not found']);
	}

}
