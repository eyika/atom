<?php

// PHPUnit bootstrap: load the autoloader + framework helpers and point base_path() at
// the application root so the test harness can boot the app.
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/eyika/atom-framework/src/helpers.php';

$GLOBALS['base_path'] = dirname(__DIR__);
