<?php
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../vendor/eyika/atom-framework/src/helpers.php";

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/../database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/../database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => env('DB_ADAPTER'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME').'_db',
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
            'charset' => env('DB_CHARSET', 'utf8'),
        ],
        'development' => [
            'adapter' => env('DB_ADAPTER'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
            'charset' => env('DB_CHARSET', 'utf8'),
        ],
        'testing' => [
            'adapter' => env('DB_ADAPTER'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
            'charset' => env('DB_CHARSET', 'utf8'),
        ]
    ],
    'version_order' => 'creation'
];
