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

    public function register(string $name, Command $command)
    {
        $this->commands[$name] = $command;
    }

    public function run(string $name, array $arguments = [])
    {
        if (isset($this->commands[$name])) {
            $this->status = $this->commands[$name]->handle($arguments);
        } else {
            echo "Error: Command '$name' not found." . PHP_EOL;
        }
    }
}
