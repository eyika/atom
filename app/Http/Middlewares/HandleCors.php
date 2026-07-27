<?php

namespace App\Http\Middlewares;

use Closure;
use Eyika\Atom\Framework\Http\BaseResponse;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Contracts\MiddlewareInterface;

class HandleCors implements MiddlewareInterface
{
    /**
     * List of allowed origins.
     *
     * @var array
     */
    protected $allowedOrigins = ['*'];

    /**
     * List of allowed HTTP methods.
     *
     * @var array
     */
    protected $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'];

    /**
     * List of allowed headers.
     *
     * @var array
     */
    protected $allowedHeaders = ['Content-Type', 'Authorization', 'X-Requested-With'];

    /**
     * List of exposed headers.
     *
     * @var array
     */
    protected $exposedHeaders = [];

    /**
     * Maximum age for preflight requests.
     *
     * @var int
     */
    protected $maxAge = 0;

    /**
     * Whether to allow credentials.
     *
     * @var bool
     */
    protected $allowCredentials = false;

    public function __construct()
    {
        $this->allowedOrigins = config('cors.allowed_origins', $this->allowedOrigins);
        $this->allowedMethods = config('cors.allowed_methods', $this->allowedMethods);
        $this->allowedHeaders = config('cors.allowed_headers', $this->allowedHeaders);
        $this->exposedHeaders = config('cors.exposed_headers', $this->exposedHeaders);
        $this->allowCredentials = config('cors.supports_credentials', $this->allowCredentials);
        $this->maxAge = config('cors.max_age', $this->maxAge);
    }

    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        if (!config('cors.apply_cors', true)) {
            return $next($request);
        }

        if ($this->isCorsRequest($request)) {
            if ($this->isPreflightRequest($request)) {
                return $this->handlePreflight($request);
            }

            return $this->addCorsHeaders($request, $next($request));
        }

        return $next($request);
    }

    /**
     * Determine if the request is a CORS request.
     *
     * @param Request $request
     * @return bool
     */
    protected function isCorsRequest(Request $request): bool
    {
        return $request->hasHeader('Origin') && 
            $request->headers('Origin') !== $request->schemeAndHttpHost();
    }

    /**
     * Determine if the request is a preflight request.
     *
     * @param Request $request
     * @return bool
     */
    protected function isPreflightRequest(Request $request): bool
    {
        return $request->isMethod('OPTIONS') &&
            $request->hasHeader('Access-Control-Request-Method');
    }

    /**
     * Handle a preflight CORS request.
     *
     * @param Request $request
     * @return BaseResponse
     */
    protected function handlePreflight(Request $request): BaseResponse
    {
        $response = new BaseResponse('', 200);
        return $this->addCorsHeaders($request, $response)
            ->setHeader('Content-Type', 'text/html; charset=utf-8');
    }

    /**
     * Add CORS headers to the response.
     *
     * @param Request $request
     * @param BaseResponse $response
     * @return BaseResponse
     */
    protected function addCorsHeaders(Request $request, BaseResponse $response): BaseResponse
    {
        $origin = $request->headers('Origin');

        if ($this->allowedOrigins[0] === '*' || in_array($origin, $this->allowedOrigins)) {
            $response->setHeader('Access-Control-Allow-Origin', $origin);
            $response->setHeader('Access-Control-Allow-Methods', implode(', ', $this->allowedMethods));
            $response->setHeader('Access-Control-Allow-Headers', implode(', ', $this->allowedHeaders));

            if (!empty($this->exposedHeaders)) {
                $response->setHeader('Access-Control-Expose-Headers', implode(', ', $this->exposedHeaders));
            }

            if ($this->allowCredentials) {
                $response->setHeader('Access-Control-Allow-Credentials', 'true');
            }

            if ($this->maxAge > 0) {
                $response->setHeader('Access-Control-Max-Age', (string) $this->maxAge);
            }
        }

        return $response;
    }
}
