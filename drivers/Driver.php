<?php

namespace anovsiradj\sqlrun\drivers;

class Driver
{
	public $logs = [];

	public function logs($key)
	{
		$logs = array_map(fn ($log) => $log[$key] ?? null, $this->logs);
		$logs = array_filter($logs, fn ($log) => isset($log));
		return $logs;
	}

	public function query($sql)
	{
		echo "[SKIP] {$sql}", PHP_EOL;
	}
}
