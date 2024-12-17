<?php

namespace App\Console\Commands;

use Eyika\Atom\Framework\Foundation\Console\Command;

class SampleEmptyCommand extends Command
{
    public function handle(array $arguments = []): bool
    {
        return false;
    }
}
