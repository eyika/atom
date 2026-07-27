<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\Contracts\ConsoleKernel;
use Eyika\Atom\Framework\Foundation\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->instance('console.kernel', $this->app->make(ConsoleKernel::class));
    }

    public function boot(): void
    {
        $kernel = $this->app->make(ConsoleKernel::class);
        $kernel->loadCommands();
        $kernel->loadProjectCommands();
        $kernel->loadFacades();
    }
}
