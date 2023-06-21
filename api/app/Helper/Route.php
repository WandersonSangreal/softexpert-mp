<?php

namespace App\Helper;

class Route
{
	private $resources = ['index', 'show', 'store', 'update', 'destroy'];

	private static function runMethod($controller, $action)
	{
		$instance = new $controller();

		return $instance->$action();

	}

	public static function get($controller, $action = null)
	{
		echo Route::runMethod($controller, ($action ?? 'index'));
	}

	public static function post($controller, $action = null)
	{
		echo Route::runMethod($controller, ($action ?? 'store'));
	}

	public static function put($controller, $action = null)
	{
		echo Route::runMethod($controller, ($action ?? 'update'));
	}

	public static function delete($controller, $action = null)
	{
		echo Route::runMethod($controller, ($action ?? 'destroy'));
	}

	public static function notFound()
	{
		header($_SERVER["SERVER_PROTOCOL"] . "/1.0 404 Not Found", true, 404);

		echo json_encode(['status' => 'error', 'message' => '404 - page not found']);
	}

}
