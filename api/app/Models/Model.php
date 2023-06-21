<?php


namespace App\Models;


use App\Helper\Connection;
use App\Helper\QueryBuilder;
use PDO;

abstract class Model extends Connection
{
	private QueryBuilder $builder;

	public function __construct()
	{
		parent::__construct("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

		$this->builder = new QueryBuilder();
	}

	public function create(array $props)
	{
		$query = $this->builder->table($this->table)->insert(array_keys($props));

		$stmt = $this->connection()->prepare($query);

		$stmt->execute($props);

		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

	public function fetchAll(array $fields): array
	{
		$query = $this->builder->table($this->table)->select($fields);

		$stmt = $this->connection()->prepare($query);

		$stmt->execute([]);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function update(array $props, ...$args)
	{
		$query = $this->builder->table($this->table)->update(array_keys($props))->where();

		$stmt = $this->connection()->prepare($query);

		$stmt->execute($props);

		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

}
