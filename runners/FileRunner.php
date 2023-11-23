<?php

namespace anovsiradj\sqlrun\runners;

use Exception;

class FileRunner extends Runner
{
	public function run($file)
	{
		if (preg_match('/\.sql$/i', $file) !== false) {
			$this->runSql($file);
		} elseif (preg_match('/\.php$/i', $file) !== false) {
			$this->runPhp($file);
		} else {
			echo "[SKIP] {$file}", PHP_EOL;
		}
	}

	public function runDir($dir)
	{
		if (empty($dir)) {
			echo '[SKIP] loopExec', PHP_EOL;
		}

		$files = glob($dir . '/{,*/}*', GLOB_BRACE);
		foreach ($files as $file) {
			$this->run($file);
		}
	}

	public function runSql($file)
	{
		$sql = file_get_contents($file);

		if ($this->driver->query($sql)) {
			echo "[DONE] {$file}", PHP_EOL;
		} else {
			echo "[FAIL] {$file}", PHP_EOL;
		}
	}

	public function runPhp($file)
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
