<?php

namespace App\Http;

use Eyika\Atom\Framework\Foundation\Kernel as FoundationKernel;
// App-level middlewares (scaffolded in this template — edit them freely).
use App\Http\Middlewares\EncryptCookies;
use App\Http\Middlewares\HandleCors;
use App\Http\Middlewares\PreventRequestsDuringMaintenance;
use App\Http\Middlewares\TrimStrings;
use App\Http\Middlewares\TrustProxies;
// Framework-shipped middlewares.
use Eyika\Atom\Framework\Http\Middlewares\ConvertEmptyStringsToNull;
use Eyika\Atom\Framework\Http\Middlewares\ServePublicAssets;
use Eyika\Atom\Framework\Http\Middlewares\ShareErrorsFromSession;
use Eyika\Atom\Framework\Http\Middlewares\StartSession;
use Eyika\Atom\Framework\Http\Middlewares\SubstituteBindings;
use Eyika\Atom\Framework\Http\Middlewares\ValidatePostSize;
use Eyika\Atom\Framework\Http\Middlewares\VerifyCsrfToken;

class Kernel extends FoundationKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        TrustProxies::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            ServePublicAssets::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            EncryptCookies::class,
            // AddQueuedCookiesToResponse::class,  NOT Yet implemented
            // AuthenticateSession::class,
            // VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            HandleCors::class,
            ServePublicAssets::class,
            // EnsureFrontendRequestsAreStateful::class,  NOT Yet implemented
            // ThrottleRequestsMiddleware::class,
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and groups.
     *
     * @var array
     */
    protected $middlewareAliases = [
        // 'auth' => Authenticate::class,
        // 'auth.basic' => AuthenticateWithBasicAuth::class,
        // 'bindings' => SubstituteBindings::class,
        // 'cache.headers' => SetCacheHeaders::class,
        // 'can' => Authorize::class,
        // 'guest' => RedirectIfAuthenticated::class,
        // 'password.confirm' => RequirePassword::class,
        // 'signed' => ValidateSignature::class,
        // 'throttle' => ThrottleRequests::class,
        // 'role' => RoleMiddleware::class,
        // 'permission' => PermissionMiddleware::class,
        // 'role_or_permission' => RoleOrPermissionMiddleware::class,
        // 'xss' => XSS::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        // // StartSession::class,
        // // ShareErrorsFromSession::class,
        // Authenticate::class,
        // ThrottleRequests::class,
        // // AuthenticateSession::class,
        // SubstituteBindings::class,
        // Authorize::class,
    ];
}
