<?php

namespace App\Helper;

use PDO;
use PDOException;

class Connection
{

	private static PDO $db;
	private $dsn, $username, $password;

	public function __construct($dsn, $username, $password)
	{
		$this->dsn = $dsn;
		$this->username = $username;
		$this->password = $password;

		$this->connect();
	}

	private function connect()
	{
		try {

			static::$db = new PDO($this->dsn, $this->username, $this->password);

		} catch (PDOException $e) {

			throw new PDOException($e->getMessage(), $e->getCode());

		}
	}

	public function select($query, ?array $bindings = [])
	{
		$stmt = static::$db->prepare($query);

		$stmt->execute($bindings);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

}
