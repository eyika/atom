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

    public function register(string $name, Command $command, array $options = [])
    {
        $this->commands[$name] = [ 'command' => $command, 'options' => $options ];
    }

    public function run(string $name, array $arguments = [])
    {
        if (isset($this->commands[$name])) {
            $this->commands[$name]['command']->setAllowedOptions($this->commands[$name]['options']);
            $this->status = $this->commands[$name]['command']->handle($arguments);
        } else {
            consoleLog(1, "Error: Command '$name' not found." . PHP_EOL);
        }
    }
}
