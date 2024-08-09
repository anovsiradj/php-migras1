<?php

namespace App\Console\Commands;

use anovsiradj\sqlrun\drivers\LaravelDriver;
use anovsiradj\sqlrun\runners\FileRunner;

class SqlrunFile extends \Illuminate\Console\Command
{
	protected $signature = 'sqlrun:file';

	public function handle()
	{
		$runner = new FileRunner;
		$runner->driver(new LaravelDriver);

		$runner->run("{$_ENV['FILE_DIR']}/structures.sql", true);
		$runner->runDir("{$_ENV['FILE_DIR']}/patches");
		$runner->run("{$_ENV['FILE_DIR']}/contents.sql", true);

		dump($runner->driver->logs('error'));
	}
}
