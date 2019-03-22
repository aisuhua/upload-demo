<?php

return [

    /**
     * File cache configs.
     */
    'file' => [
        'dir' => dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . '.cache' . DIRECTORY_SEPARATOR,
        'name' => 'tus_php.client.cache',
    ],
];
