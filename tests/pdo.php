<?php

use anovsiradj\sqlrun\drivers\PdoDriver;
use anovsiradj\sqlrun\runners\FileRunner;

require __DIR__ . '/env.php';

$connect = new PDO($env['PDO_DSN'], $env['PDO_USERNAME'], $env['PDO_PASSWORD']);

$driver = new PdoDriver;
$driver->connect($connect);
$driver->migration = true;

$runner = new FileRunner;
$runner->driver($driver);

$runner->run("{$env['FILE_DIR']}/structures.sql");
$runner->runDir("{$env['FILE_DIR']}/patches");
$runner->run("{$env['FILE_DIR']}/contents.sql");

// dump($driver->logs);
dump($driver->logs('error'));
