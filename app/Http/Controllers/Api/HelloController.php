<?php

namespace App\Http\Controllers\Api;

use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Response;

class HelloController
{
    public function index(Request $request, string $name)
    {
        return Response::json("Hello $name", [
            'name' => $name
        ]);
    }
}