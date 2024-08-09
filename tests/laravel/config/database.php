<?php

return [
	'default' => env('LARAVEL_DRIVER'),

	'connections' => [
		'sqlite' => [
			'driver' => 'sqlite',
			'database' => env('SQLITE_FILE'),
			'foreign_key_constraints' => env('LARAVEL_FOREIGN_KEYS', true),
		],
		'mysql' => [
			'driver' => 'mysql',
			'host' => env('LARAVEL_HOST'),
			'port' => env('LARAVEL_PORT'),
			'database' => env('LARAVEL_DBNAME'),
			'username' => env('LARAVEL_USERNAME'),
			'password' => env('LARAVEL_PASSWORD'),
			'charset' => 'utf8mb4',
			'collation' => 'utf8mb4_unicode_ci',
			'prefix_indexes' => true,
			'strict' => true,
			'engine' => null,
		],
		'pgsql' => [
			'driver' => 'pgsql',
			'host' => env('LARAVEL_HOST'),
			'port' => env('LARAVEL_PORT'),
			'database' => env('LARAVEL_DBNAME'),
			'username' => env('LARAVEL_USERNAME'),
			'password' => env('LARAVEL_PASSWORD'),
			'charset' => 'utf8',
			'prefix_indexes' => true,
			'schema' => 'public',
			'sslmode' => 'disable',
		],
	],

	'migrations' => 'laravel_migrations',
];
