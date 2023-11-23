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
			$this->logs[] = ['sql' => $sql, 'result' => $result];
			return true;
		} catch (Exception $e) {
			$this->logs[] = ['sql' => $sql, 'error' => $e->getMessage()];
			return false;
		}
	}
}
