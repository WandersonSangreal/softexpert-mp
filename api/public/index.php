<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

if (file_exists(__DIR__ . '/../routes/api.php')) {
	require __DIR__ . '/../routes/api.php';
}
