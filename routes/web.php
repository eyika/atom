<?php

use App\Http\Controllers\HelloController;
use Eyika\Atom\Framework\Http\Response;
use Eyika\Atom\Framework\Http\Route;

Route::get('', function () {
    return Response::view('index');
});

Route::get('/name/$name', [HelloController::class, 'index']);
