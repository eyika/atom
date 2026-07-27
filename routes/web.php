<?php

use App\Http\Controllers\HelloController;
use Eyika\Atom\Framework\Http\Route;
use Eyika\Atom\Framework\Support\Facade\Response;

Route::get('/', function () {
    return Response::view('index');
});

Route::get('/name/{name}', [HelloController::class, 'index']);
