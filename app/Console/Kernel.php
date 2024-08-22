<?php

namespace App\Console;

use Eyika\Atom\Framework\Foundation\ConsoleKernel;
use Eyika\Atom\Framework\Foundation\Console\Command;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    public function __construct()
    {
        $this->loadCommands();
    }
}
