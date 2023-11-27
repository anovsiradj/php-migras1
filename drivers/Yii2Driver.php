<?php

namespace anovsiradj\sqlrun\drivers;

use yii\db\Connection;
use yii\db\Exception;

class Yii2Driver extends Driver
{
	public Connection $connect;

	public function connect(Connection &$connect)
	{
		$this->connect = $connect;
	}

	public function query($sql)
	{
		if (empty($sql)|| empty(trim($sql))) {
			$this->logs[] = ['sql' => $sql, 'error' => 'empty'];
			return false;
		}

		try {
			$result = $this->connect->createCommand($sql)->execute();

			$this->logs[] = [
				'query' => $sql,
				'result' => $result,
			];
			return true;

		} catch (Exception $e) {
			$this->logs[] = [
				'query' => $sql,
				'error' => $e->getMessage(),
			];
			return false;
		}
	}
}
