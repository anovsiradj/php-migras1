<?php

use anovsiradj\sqlrun\drivers\PdoDriver;
use anovsiradj\sqlrun\runners\FileRunner;

require __DIR__ . '/env.php';

$connect = new PDO("mysql:host={$env['PDO_MYSQL_HOST']};dbname={$env['PDO_MYSQL_DBNAME']}", $env['PDO_MYSQL_USER'], $env['PDO_MYSQL_PASS']);

$driver = new PdoDriver;
$driver->connect($connect);

$runner = new FileRunner;
$runner->driver($driver);

$runner->exec("{$env['MYSQL_FILE_DIR']}/structures.sql");
$runner->loopExec("{$env['MYSQL_FILE_DIR']}/patches");
$runner->exec("{$env['MYSQL_FILE_DIR']}/contents.sql");

dump($driver->logs('error'));
