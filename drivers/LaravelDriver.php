<?php

namespace anovsiradj\sqlrun\drivers;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LaravelDriver extends Driver
{
	public $migration = true;

	public ConnectionInterface $connect;

	public function __construct()
	{
		$this->connect(DB::connection());
	}

	/**
	 * @param ConnectionInterface $connect
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
			$result = $this->connect->unprepared($sql);
			$this->logs[] = ['query' => $sql, 'result' => $result];
			return $result;
		} catch (QueryException $e) {
			$this->logs[] = ['query' => $sql, 'error' => $e->getMessage()];
			return false;
		}
	}

	public function migrationExist($name)
	{
		if (!$this->migration) {
			return false;
		}

		$table = config('database.migrations');
		$model = $this->connect->table($table)->where('migration', '=', $name)->first();

		if (isset($model)) {
			return true;
		}
	}

	public function migrationInsert($name)
	{
		if (!$this->migration) {
			return;
		}

		$table = config('database.migrations');
		$this->connect->table($table)->insertOrIgnore([
			'migration' => $name,
			'batch' => time(), // TIMESTAMP
		]);
	}
}
