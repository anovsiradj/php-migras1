<?php

require __DIR__ . '/../vendor/autoload.php';

// (new \Symfony\Component\Dotenv\Dotenv)->usePutenv(true)->load(__DIR__ . '/.env');

$dotenv = new Symfony\Component\Dotenv\Dotenv;
$env = $dotenv->parse(file_get_contents(__DIR__ . '/.env'));
