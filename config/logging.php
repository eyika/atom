<?php
use Monolog\Handler\StreamHandler;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */
    'default' => env('LOG_CHANNEL', 'single'),
    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Atom uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'bugsnag'],
        ],
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/atom.log'),
            'level' => 'debug',
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/atom.log'),
            'level' => 'debug',
            'days' => 14,
        ],
        'email' => [
            'driver' => 'email',
            'path' => storage_path('logs/email.log'),
            'level' => 'debug',
        ],
        'webhook' => [
            'driver' => 'monolog',
            'path' => storage_path('logs/webhook.log'),
            'level' => 'debug',
        ],
        'custom' => [
            'driver' => 'custom',
            'path' => storage_path('logs/custom.log'),
            'level' => 'debug',
        ],
        'bugsnag' => [
            'driver' => 'bugsnag',
        ],
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Atom Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],
        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],
        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],
        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],
];
