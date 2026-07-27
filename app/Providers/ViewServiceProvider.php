<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\ServiceProvider;
use Eyika\Atom\Framework\Support\View\Blade;
use Eyika\Atom\Framework\Support\View\Twig;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Blade::class, function () {
            return new Blade();
        });
        $this->app->singleton(Twig::class, function () {
            return new Twig();
        });

        $this->app->instance('view.blade', $this->app->make(Blade::class));
        $this->app->instance('view.twig', $this->app->make(Twig::class));
    }

    public function boot(): void
    {
        //
    }
}
