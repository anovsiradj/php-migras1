<?php

namespace anovsiradj\sqlrun\runners;

use anovsiradj\sqlrun\drivers\Driver;

class Runner
{
	public Driver $driver;

	public function driver(Driver &$driver)
	{
		$this->driver = $driver;
	}
}
