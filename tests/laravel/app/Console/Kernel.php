<?php

namespace App\Console;

class Kernel extends \Illuminate\Foundation\Console\Kernel
{
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');
	}
}
