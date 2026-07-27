<?php

namespace App\Http\Controllers;

use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Support\Facade\Response;

class HelloController extends Controller
{
    public function index(Request $request, string $name)
    {
        return Response::view('index', ['name' => $name]);
    }
}
