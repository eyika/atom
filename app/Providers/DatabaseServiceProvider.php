<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\ServiceProvider;
use Eyika\Atom\Framework\Support\Database\Connection;
use Eyika\Atom\Framework\Support\Facade\DatabaseConnection;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Connection::class, function () {
            return new Connection(config('database'));
        });

        $this->app->instance('db.connection', $this->app->make(Connection::class));
    }

    public function boot(): void
    {
        DatabaseConnection::connect();
    }
}
