<?php

return [

    /**
     * This will determine wether to use Advance Templating Bladelike Templating Engine
     * For Compiling Views and Email Templates or Basic Twig-like Templating Engine
     */
    'use_advance_engine' => env('USE_ADVANCE_ENGINE', 'true') == 'true',

    /**
     * This will determine if the engine will work in fast mode or debug mode
     * 
     * options are: 0: auto, 1: slow, 2: fast, 5: debug
     * 
     * A reasonable default has been set
     */
    'mode' => env('VIEW_MODE'),

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Atom view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        storage_path('framework/views')
    ),

];
