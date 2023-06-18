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
		return Route::runMethod($controller, ($action ?? 'index'));
	}

}
