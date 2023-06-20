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

	public static function notFound()
	{
		header($_SERVER["SERVER_PROTOCOL"] . "/1.0 404 Not Found", true, 404);

		echo json_encode(['status' => 'error', 'message' => '404 - page not found']);
	}

}
