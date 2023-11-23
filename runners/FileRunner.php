<?php

namespace anovsiradj\sqlrun\runners;

use Exception;

class FileRunner extends Runner
{
	public function exec($file)
	{
		if (preg_match('/\.sql$/i', $file) !== false) {
			$this->execSql($file);
		} elseif (preg_match('/\.php$/i', $file) !== false) {
			$this->execPhp($file);
		} else {
			echo "[SKIP] {$file}", PHP_EOL;
		}
	}

	public function loopExec($dir)
	{
		if (empty($dir)) {
			echo '[SKIP] loopExec', PHP_EOL;
		}

		$files = glob($dir . '/{,*/}*', GLOB_BRACE);
		foreach ($files as $file) {
			$this->exec($file);
		}
	}

	public function execSql($file)
	{
		$sql = file_get_contents($file);

		if ($this->driver->query($sql)) {
			echo "[DONE] {$file}", PHP_EOL;
		} else {
			echo "[FAIL] {$file}", PHP_EOL;
		}
	}

	public function execPhp($file)
	{
		extract((array) $this);

		try {
			require $file;
			echo "[DONE] {$file}", PHP_EOL;
		} catch (Exception $e) {
			echo "[FAIL] {$e->getMessage()}", PHP_EOL;
		}
	}
}
