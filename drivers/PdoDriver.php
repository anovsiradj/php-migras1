<?php

namespace anovsiradj\sqlrun\drivers;

use Exception;
use PDO;

class PdoDriver extends Driver
{
	public PDO $connect;

	public function connect(PDO &$connect)
	{
		$this->connect = $connect;
	}

	public function query($sql)
	{
		try {
			$result = $this->connect->exec($sql);
			$this->logs[] = ['query' => $sql, 'result' => $result];
			return true;
		} catch (Exception $e) {
			$this->logs[] = ['query' => $sql, 'error' => $e->getMessage()];
			return false;
		}
	}
}
