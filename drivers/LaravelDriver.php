<?php

namespace anovsiradj\sqlrun\drivers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class LaravelDriver extends Driver
{
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
}
