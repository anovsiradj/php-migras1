<?php

return [
	'env' => 'development',
	'name' => 'sqlrun',
	'debug' => true,

	'providers' => [
		Illuminate\Cache\CacheServiceProvider::class,
		Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
		Illuminate\Database\DatabaseServiceProvider::class,
		Illuminate\Filesystem\FilesystemServiceProvider::class,
		Illuminate\Queue\QueueServiceProvider::class,
	],
];
