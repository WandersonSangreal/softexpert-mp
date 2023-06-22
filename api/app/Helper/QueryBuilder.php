<?php

namespace App\Helper;


class QueryBuilder
{
	const INSERT_TYPE = 0;
	const UPDATE_TYPE = 1;
	const SELECT_TYPE = 2;

	private array $fields = [];
	private array $conditions = [];
	private array $order = [];
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

	public function where($where): self
	{
		foreach ($where as $key => $arg) {
			array_push($this->conditions, $key);
		}
		return $this;
	}

	public function table(string $table): self
	{
		$this->table = $table;
		return $this;
	}

	public function order(array $order): self
	{
		$this->order = $order;
		return $this;
	}

	public function dump()
	{
		$table = $this->table;
		$where = $this->conditions === [] ? '' : 'WHERE ' . str_replace('=', ' = :', http_build_query(array_combine($this->conditions, $this->conditions), null, ' AND '));
		$order = $this->order === [] ? '' : 'ORDER BY ' . str_replace('=', ' ', http_build_query($this->order, null, ', '));
		$binds = preg_filter('/^/', ':', $this->fields);
		$fields = implode(', ', $this->fields);

		$composition = [
			"INSERT INTO {$table} ({$fields}) VALUES (" . implode(', ', $binds) . ") {$where} returning *",
			"UPDATE {$table} SET " . str_replace('=', ' = :', http_build_query(array_combine($this->fields, $this->fields), null, ', ')) . " {$where} returning *",
			"SELECT {$fields} FROM {$table} {$where} {$order}"
		];

		if (array_key_exists($this->type, $composition)) {
			return "{$composition[$this->type]};";
		}

		return null;

	}

	public function __toString()
	{
		return $this->dump();
	}

}
