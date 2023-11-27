<?php

namespace anovsiradj\sqlrun\runners;

use anovsiradj\sqlrun\drivers\Driver;

class Runner
{
	public Driver $driver;

	public function driver($driver)
	{
		$this->driver = $driver;
	}
}
