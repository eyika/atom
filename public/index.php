<?php
declare(strict_types=1);

use Eyika\Atom\Framework\Http\Server;

date_default_timezone_set('UTC');
define('ATOM_START', microtime(true));

$log_path = __DIR__."/../storage/logs/php_error.log";
ini_set('error_log', $log_path);

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Register The Helper Functions
|--------------------------------------------------------------------------
|
| The helper functions file provide couple of useful short helper functions
| for performing regular computations.
|
*/
require_once __DIR__."/../vendor/eyika/atom-framework/src/helpers.php";

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

try {
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $server = new Server($app);
    $server->handle();
} catch (\Exception $e) {
    echo $e->getMessage();
}
