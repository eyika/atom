<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\Event\Dispatcher;
use Eyika\Atom\Framework\Foundation\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event → listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected array $listen = [
        // \App\Events\UserRegistered::class => [
        //     \App\Listeners\SendWelcomeEmail::class,
        // ],
    ];

    public function register(): void
    {
        $this->app->singleton(Dispatcher::class, function () {
            return new Dispatcher();
        });

        $this->app->instance('events', $this->app->make(Dispatcher::class));
    }

    public function boot(): void
    {
        $dispatcher = $this->app->make(Dispatcher::class);
        $dispatcher->registerListeners($this->listen);
    }
}
