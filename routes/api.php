<?php

use Eyika\Atom\Framework\Http\JsonResponse;
use Eyika\Atom\Framework\Http\Route;

Route::get('', function () {
    return JsonResponse::ok('hello world api');
});
