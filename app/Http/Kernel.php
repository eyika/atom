<?php

namespace App\Http;

use Basttyy\FxDataServer\Middlewares\ThrottleRequestsMiddleware;
use Eyika\Atom\Framework\Foundation\Kernel as FoundationKernel;
use Eyika\Atom\Framework\Http\Middlewares\AuthenticateSession;
use Eyika\Atom\Framework\Http\Middlewares\ConvertEmptyStringsToNull;
use Eyika\Atom\Framework\Http\Middlewares\EncryptCookies;
use Eyika\Atom\Framework\Http\Middlewares\HandleCors;
use Eyika\Atom\Framework\Http\Middlewares\PreventRequestsDuringMaintenance;
use Eyika\Atom\Framework\Http\Middlewares\ShareErrorsFromSession;
use Eyika\Atom\Framework\Http\Middlewares\StartSession;
use Eyika\Atom\Framework\Http\Middlewares\SubstituteBindings;
use Eyika\Atom\Framework\Http\Middlewares\TrimStrings;
use Eyika\Atom\Framework\Http\Middlewares\TrustProxies;
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
            StartSession::class,
            ShareErrorsFromSession::class,
            EncryptCookies::class,
            // AddQueuedCookiesToResponse::class,  NOT Yet implemented
            AuthenticateSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            HandleCors::class,
            // EnsureFrontendRequestsAreStateful::class,  NOT Yet implemented
            ThrottleRequestsMiddleware::class.':api',
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
