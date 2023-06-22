<?php


namespace App\Models;


use App\Helper\Connection;
use App\Helper\QueryBuilder;
use Doctrine\Inflector\InflectorFactory;
use PDO;

abstract class Model extends Connection
{
	private QueryBuilder $builder;
	public string $table;

	public function __construct()
	{
		parent::__construct("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

		$inflector = InflectorFactory::create()->build();

		$this->builder = new QueryBuilder();
		$this->table = $this->table ?? $inflector->pluralize(strtolower((new \ReflectionClass($this))->getShortName()));
	}

	public function create(array $props)
	{
		$query = $this->builder->table($this->table)->insert(array_keys($props));

		$stmt = $this->connection()->prepare($query);

		$stmt->execute($props);

		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

	public function fetchAll(array $fields, array $args = [], array $order = [], $fetch = PDO::FETCH_ASSOC): array
	{
		$query = $this->builder->table($this->table)->select($fields)->where($args)->order($order);

		$stmt = $this->connection()->prepare($query);

		$stmt->execute($args);

		return $stmt->fetchAll($fetch);
	}

	public function update(array $props, array $args)
	{
		$query = $this->builder->table($this->table)->update(array_keys($props))->where($args);

		$stmt = $this->connection()->prepare($query);

		$stmt->execute(array_merge($props, $args));

		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

}
