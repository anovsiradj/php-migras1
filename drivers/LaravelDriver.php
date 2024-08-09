<?php

namespace anovsiradj\sqlrun\drivers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LaravelDriver extends Driver
{
	public $migration = true;

	public function query($sql)
	{
		if (empty($sql) || trim($sql) === '') {
			$this->logs[] = ['query' => $sql, 'error' => 'empty'];
			return false;
		}

		try {
			$result = DB::unprepared($sql);
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
		$model = DB::table($table)->where('migration', '=', $name)->first();

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
		DB::table($table)->insertOrIgnore([
			'migration' => $name,
			'batch' => time(), // TIMESTAMP
		]);
	}
}
