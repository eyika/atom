<?php

namespace App\Http;

use Eyika\Atom\Framework\Foundation\Kernel as FoundationKernel;

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
        // TrustProxies::class,
        // PreventRequestsDuringMaintenance::class,
        // ValidatePostSize::class,
        // TrimStrings::class,
        // ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // StartSession::class,
            // ShareErrorsFromSession::class,
            // EncryptCookies::class,
            // AddQueuedCookiesToResponse::class,
            // AuthenticateSession::class,
            // VerifyCsrfToken::class,
            // SubstituteBindings::class,
        ],

        'api' => [
            // HandleCors::class,
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            // SubstituteBindings::class,
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
        // 'verified' => EnsureEmailIsVerified::class,
        // 'role' => RoleMiddleware::class,
        // 'permission' => PermissionMiddleware::class,
        // 'role_or_permission' => RoleOrPermissionMiddleware::class,
        // 'xss' => XSS::class,
        // 'checkUserStatus' => CheckUserStatus::class,
        // 'modules' => CheckModule::class,
        // 'setLanguage' => SetLanguage::class,
        // 'languageChangeName' => LanguageChangeMiddleware::class,
        // 'multi_tenant' => MultiTenantMiddleware::class,
        // 'check_impersonate' => CheckImpersonateUser::class,
        // 'setTenantFromUsername' => SetTenantFromUsername::class,
        // 'check_super_admin_role' => CheckSuperAdminRole::class,
        // 'check_subscription' => CheckSubscription::class,
        // 'check_menu_access' => CheckMenuAccess::class,
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
