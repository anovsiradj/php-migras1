<?php

require __DIR__ . '/env.php';

define('YII_DEBUG', true);
define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$app = new yii\console\Application([
	'id' => 'sqlrun',
	'name' => 'sqlrun',
	'basePath' => __DIR__,
	'controllerPath' => realpath(__DIR__ . '/yii2/controllers'), // why this not work?
	'controllerNamespace' => 'sqlrun\yii2\controllers',
	'aliases' => [
		'@sqlrun' => __DIR__, // why must use this?
	],
	'components' => [
		'db' => [
			'class' => yii\db\Connection::class,
			'dsn' => $env['YII_DSN'],
			'username' => $env['YII_USERNAME'],
			'password' => $env['YII_PASSWORD'],
		],
	],
]);

$die = $app->run();
exit($die);
