<?php

namespace anovsiradj\sqlrun\runners;

use Exception;

class FileRunner extends Runner
{
	public function run($file, $migrationIgnore = false)
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
			$this->runSql($file, $migrationIgnore);
		} elseif (preg_match('/\.php$/i', $file) === 1) {
			$this->runPhp($file, $migrationIgnore);
		} else {
			echo "[SKIP] unknown file {$file}", PHP_EOL;
		}
	}

	public function runDir($dir, $migrationIgnore = false)
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
			$this->run($file, $migrationIgnore);
		}
	}

	public function runSql($file, $migrationIgnore = false)
	{
		if (!$migrationIgnore && $this->driver->migrationExist(basename($file))) {
			echo "[MGRT] {$file}", PHP_EOL;
			return;
		}

		$sql = file_get_contents($file);

		if ($this->driver->query($sql)) {
			if (!$migrationIgnore) {
				$this->driver->migrationInsert(basename($file));
			}
			echo "[DONE] {$file}", PHP_EOL;
		} else {
			echo "[FAIL] {$file}", PHP_EOL;
		}
	}

	public function runPhp($file, $migrationIgnore = false)
	{
		if (!$migrationIgnore && $this->driver->migrationExist(basename($file))) {
			echo "[MGRT] {$file}", PHP_EOL;
			return;
		}

		$closure = function () use ($file) {
			extract((array) $this);
			return (require $file);
		};

		try {
			$result = $closure();

			if ($result === false) {
				echo "[FAIL] {$file}", PHP_EOL;
			} else {
				if (!$migrationIgnore) {
					$this->driver->migrationInsert(basename($file));
				}
				echo "[DONE] {$file}", PHP_EOL;
			}
		} catch (Exception $e) {
			$this->driver->logs[] = ['error' => $e->getMessage()];
			echo "[FAIL] {$file}", PHP_EOL;
		}
	}
}
