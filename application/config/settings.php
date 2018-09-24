<?php

return [
    'settings' => [
        'displayErrorDetails'    => env('DEBUG', false), // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer'               => [
            'template_path' => __DIR__ . '/../views/',
            'twig'          => [
                'cache'       => __DIR__ . '/../cache/views/',
                'auto_reload' => true
            ]
        ],

        // Monolog settings
        'logger'                 => [
            'name'  => 'slim-app',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'storage' => [
            'defaultDir' => __DIR__ . '/../public/files/',
            'public'     => env('SITE_URL') . '/files/',
        ],

        'db' => [
            'host'   => env('MYSQL_HOST', '127.0.0.1'),
            'user'   => env('MYSQL_USER', 'root'),
            'pass'   => env('MYSQL_PASSWORD', ''),
            'dbname' => env('MYSQL_DATABASE', 'database'),

            'tables' => [
                'files'      => 'files_table',
                'file_pages' => 'file_pages_table',
            ]
        ]
    ],
];
