<?php

namespace App\Providers;

use Eyika\Atom\Framework\Foundation\ServiceProvider;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Route::class, function () {
            return new Route();
        });

        $this->app->instance('router', $this->app->make(Route::class));
    }

    /**
     * Wire requests to route files. The framework no longer hardcodes the web/api
     * choice: each Route::map() declares a matcher + middleware group + route file, and
     * the first map whose matcher accepts the request handles it (the matcher-less map
     * is the fallback). Add your own map types here as needed (admin, webhook, …) — you
     * are free to decide how requests are routed.
     */
    public function boot(): void
    {
        // API: JSON/AJAX/OPTIONS requests, or anything under /api. Stateless (no
        // "previous URL" session write).
        Route::map('api')
            ->middleware('api')
            ->stateless()
            ->when(fn (Request $request) =>
                $request->wantsJson()
                || $request->isXmlHttpRequest()
                || $request->isOptions()
                || str_starts_with('/' . ltrim(strtok($request->pathInfo(), '?'), '/'), '/api'))
            ->load(base_path('routes/api.php'));

        // Web: the fallback for everything else (no matcher).
        Route::map('web')
            ->middleware('web')
            ->load(base_path('routes/web.php'));
    }
}
