<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\ServiceProvider;
use Eyika\Atom\Framework\Support\Database\Connection;

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
        // Intentionally does NOT open the connection here. The DB connects lazily on the first
        // query (Connection::exec()), so DB-less commands — e.g. the vendor:publish that runs
        // during `composer install`/`update` — and fresh installs with no database yet still boot.
        // Eagerly connecting here made every artisan command (and a fresh install) fatal when the
        // database was unconfigured or unreachable.
    }
}
