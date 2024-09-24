<?php

namespace App\Console;

use Eyika\Atom\Framework\Foundation\ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    public function __construct()
    {
        parent::__construct();
    }
}
