<?php

namespace anovsiradj\sqlrun\drivers;

class Driver
{
	public $logs = [];

	public $migration = false;

	public function logs($key)
	{
		$logs = array_map(fn ($log) => $log[$key] ?? null, $this->logs);
		$logs = array_filter($logs, fn ($log) => isset($log) && trim($log) !== '');
		return $logs;
	}

	/**
	 * @return bool
	 */
	public function query($sql)
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return false;
	}

	public function fetchOne($sql, $params = [])
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return null;
	}

	public function fetchAll($sql, $params = [])
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return null;
	}

	public function fetchScalar($sql, $params = [])
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return null;
	}

	public function migrationExist($name)
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return null;
	}

	public function migrationInsert($name)
	{
		$this->logs[] = array_merge(func_get_args(), ['error' => 'unimplemented']);
		return null;
	}
}
