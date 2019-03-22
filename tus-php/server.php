<?php
require(__DIR__ . '/vendor/autoload.php');

// server.php

\TusPhp\Config::set(__DIR__ . '/config/server.php');

$server   = new \TusPhp\Tus\Server(); // Leave empty for file based cache
$uploadPath = '/www/web/upload-demo/tus-php/.upload';
$server->setUploadDir($uploadPath);

$response = $server->serve();

$response->send();

exit(0); // Exit from current PHP process.