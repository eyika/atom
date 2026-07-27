<?php

use Eyika\Atom\Framework\Http\Route;
use Eyika\Atom\Framework\Support\Facade\JsonResponse;

Route::get('/', function () {
    return JsonResponse::ok('hello world api');
});
