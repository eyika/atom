<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\ServiceProvider;
use Eyika\Atom\Framework\Support\Cache\Cache;

class CacheServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Cache::class, function () {
            return new Cache();
        });

        $this->app->instance('cache', $this->app->make(Cache::class));
    }

    public function boot(): void
    {
    }
}
