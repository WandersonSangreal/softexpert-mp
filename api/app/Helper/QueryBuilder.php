<?php

namespace App\Helper;


class QueryBuilder
{
	const INSERT_TYPE = 0;
	const UPDATE_TYPE = 1;
	const SELECT_TYPE = 2;

	private array $fields = [];
	private array $conditions = [];
	private string $table;
	private string $type;

	public function select(array $fields): self
	{
		$this->type = self::SELECT_TYPE;
		$this->fields = $fields;
		return $this;
	}

	public function insert(array $fields): self
	{
		$this->type = self::INSERT_TYPE;
		$this->fields = $fields;
		return $this;
	}

	public function update(array $fields): self
	{
		$this->type = self::UPDATE_TYPE;
		$this->fields = $fields;
		return $this;
	}

	public function where(string ...$where): self
	{
		foreach ($where as $arg) {
			array_push($this->conditions, $arg);
		}
		return $this;
	}

	public function table(string $table): self
	{
		$this->table = $table;
		return $this;
	}

	public function dump()
	{
		$table = $this->table;
		$where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
		$binds = preg_filter('/^/', ':', $this->fields);
		$fields = implode(', ', $this->fields);

		$composition = [
			"INSERT INTO {$table} ({$fields}) VALUES (" . implode(', ', $binds) . ")",
			"UPDATE {$table} SET " . str_replace('=', ' = :', http_build_query(array_combine($this->fields, $this->fields), null, ', ')),
			"SELECT {$fields} FROM {$table}"
		];

		if (array_key_exists($this->type, $composition)) {
			return "{$composition[$this->type]} {$where};";
		}

		return null;

	}

	public function __toString()
	{

		$table = $this->table;
		$where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
		$binds = preg_filter('/^/', ':', $this->fields);
		$fields = implode(', ', $this->fields);

		$composition = [
			"INSERT INTO {$table} ({$fields}) VALUES (" . implode(', ', $binds) . ")",
			"UPDATE {$table} SET " . str_replace('=', ' = :', http_build_query(array_combine($this->fields, $this->fields), null, ', ')),
			"SELECT {$fields} FROM {$table}"
		];

		if (array_key_exists($this->type, $composition)) {
			return "{$composition[$this->type]} {$where};";
		}

		return null;

	}

}
