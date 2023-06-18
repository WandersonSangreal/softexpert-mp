<?php


namespace App\Models;


use App\Helper\Connection;

abstract class Model extends Connection
{
	public function __construct(array $props)
	{
		foreach ($props as $key => $prop) {
			$this->$key = $prop;
		}
	}

	public function __get($prop)
	{
		return $this->$prop;
	}

	public function __set($prop, $value)
	{
		return $this->$prop = $value;
	}

	public function save()
	{
		$this->execute();
	}

}
