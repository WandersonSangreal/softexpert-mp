<?php

namespace App\Helper;


class QueryBuilder
{
	private array $fields = [];
	private array $update = [];
	private array $conditions = [];
	private array $from = [];

	public function select(string ...$select): self
	{
		$this->fields = $select;
		return $this;
	}

	public function update(array $update): self
	{
		$this->update = $update;
		return $this;
	}

	public function where(string ...$where): self
	{
		foreach ($where as $arg) {
			array_push($this->conditions, $arg);
		}
		return $this;
	}

	public function from(string $table, ?string $alias = null): self
	{
		array_push($this->from, ($alias ? "${$table} AS ${alias}" : $table));
		return $this;
	}

	public function __toString()
	{
		$fields = implode(', ', $this->fields);
		$from = implode(', ', $this->from);
		$where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);

		return "SELECT {$fields} FROM {$from} {$where};";
	}

}
