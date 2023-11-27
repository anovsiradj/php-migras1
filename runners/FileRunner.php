<?php

namespace anovsiradj\sqlrun\runners;

use Exception;

class FileRunner extends Runner
{
	public function run($file)
	{
		if (empty($file) || trim($file) === '') {
			echo '[SKIP] file is empty', PHP_EOL;
			return;
		}

		if (!file_exists($file) || !is_file($file)) {
			echo "[SKIP] file not exist", PHP_EOL;
			return;
		}

		if (preg_match('/\.sql$/i', $file) === 1) {
			$this->runSql($file);
		} elseif (preg_match('/\.php$/i', $file) === 1) {
			$this->runPhp($file);
		} else {
			echo "[SKIP] {$file}", PHP_EOL;
		}
	}

	public function runDir($dir)
	{
		if (empty($dir) || trim($dir) === '') {
			echo '[SKIP] dir is empty', PHP_EOL;
			return;
		}

		if (!file_exists($dir) || !is_dir($dir)) {
			echo '[SKIP] dir not exist', PHP_EOL;
			return;
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
		$closure = function() use ($file) {
			extract((array) $this);
			require $file;
		};

		try {
			$result = $closure();

			if ($result === false) {
				echo "[FAIL] {$file}", PHP_EOL;
			} else {
				echo "[DONE] {$file}", PHP_EOL;
			}
		} catch (Exception $e) {
			$this->driver->logs[] = ['error' => $e->getMessage()];
			echo "[FAIL] {$file}", PHP_EOL;
		}
	}
}
