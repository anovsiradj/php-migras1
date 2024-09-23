<?php

namespace anovsiradj\sqlrun\drivers;

use PDO;
use PDOException;

class PdoDriver extends Driver
{
	public PDO $connect;

	/**
	 * @param PDO $connect
	 */
	public function connect($connect)
	{
		$this->connect = $connect;
	}

	public function query($sql)
	{
		if (empty($sql) || trim($sql) === '') {
			$this->logs[] = ['query' => $sql, 'error' => 'empty'];
			return false;
		}

		try {
			$result = $this->connect->exec($sql);

			$log = [
				'query' => $sql,
				'result' => $result,
			];

			if ($result !== false) {
				$this->logs[] = $log;
			} else {
				$this->logs[] = array_merge($log, [
					'error' => $this->connect->errorInfo()[2] ?? null,
				]);
			}
			return ($result !== false);
		} catch (PDOException $e) {
			$this->logs[] = [
				'query' => $sql,
				'error' => $e->errorInfo[2] ?? null,
			];
			return false;
		}
	}

	public function migrationExist($name)
	{
		if (!$this->migration) {
			return false;
		}

		$deklar = $this->connect->prepare(<<<SQL
			SELECT * from migrations
			WHERE migration=:migration
		SQL);

		$deklar->execute([
			':migration' => $name,
		]);

		$result = $deklar->fetch() ?: null;
		if (isset($result)) {
			return true;
		}
	}

	public function migrationInsert($name)
	{
		if (!$this->migration) {
			return;
		}

		$deklar = $this->connect->prepare(<<<SQL
			INSERT INTO
			migrations (migration, created_at)
			VALUES (:migration, :created_at)
		SQL);

		$result = $deklar->execute([
			':migration' => $name,
			':created_at' => date('c'),
		]);

		return $result;
	}
}
