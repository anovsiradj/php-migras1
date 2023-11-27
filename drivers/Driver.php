<?php

namespace anovsiradj\sqlrun\drivers;

class Driver
{
	public $logs = [];

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
		$this->logs[] = ['query' => $sql, 'error' => 'unimplemented'];
		return false;
	}

	public function fetchOne($sql)
	{
		$this->logs[] = ['query' => $sql, 'error' => 'unimplemented'];
		return null;
	}

	public function fetchAll($sql)
	{
		$this->logs[] = ['query' => $sql, 'error' => 'unimplemented'];
		return null;
	}

	public function fetchScalar($sql)
	{
		$this->logs[] = ['query' => $sql, 'error' => 'unimplemented'];
		return null;
	}
}
