<?php


namespace App\Models;


use App\Helper\Connection;
use App\Helper\QueryBuilder;

abstract class Model extends Connection
{
	public function __construct()
	{
		parent::__construct("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
	}

	public function __get($prop)
	{
		return $this->$prop;
	}

	public function __set($prop, $value)
	{
		return $this->$prop = $value;
	}

	public function create(array $props)
	{
		foreach ($props as $key => $prop) {
			$this->$key = $prop;
		}

		// $query = (new QueryBuilder())->select(...array_keys($fields))->from('products');

	}

	public function fetchAll(array $fields)
	{
		$query = (new QueryBuilder())->select(...$fields)->from('products');

		return $this->select($query);
	}

	public function save()
	{
		$this->execute();
	}

}
