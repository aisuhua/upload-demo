<?php
require(__DIR__ . '/vendor/autoload.php');

\TusPhp\Config::set(__DIR__ . '/config/client.php');

$baseUrl = 'http://upload.example.com';
$client = new \TusPhp\Tus\Client($baseUrl);

$key = 'suhua';
$client->setKey($key);

// Optional. If key is not set explicitly, the system will generate an unique uuid.
// $key = 'your unique key';

// $client->setKey($key)->file('composer.json', 'filename.ext');

// Create and upload a chunk of 1MB
// $bytesUploaded = $client->upload(1000000);

// Resume, $bytesUploaded = 2MB
// $bytesUploaded = $client->upload(1000000);


    // To upload whole file, skip length param
    $client->file('composer.json')
        ->upload();


