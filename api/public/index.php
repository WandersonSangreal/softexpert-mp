<?php

require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($className) {

	$pathFile = str_replace('\\', DIRECTORY_SEPARATOR, str_replace('App', 'app', $className)) . '.php';

	if (file_exists(realpath(__DIR__ . '/../' . $pathFile))) {
		require_once realpath(__DIR__ . '/../' . $pathFile);
	}

});

if (file_exists(__DIR__ . '/../routes/api.php')) {
	require __DIR__ . '/../routes/api.php';
}
