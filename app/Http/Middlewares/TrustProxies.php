<?php

namespace App\Http\Middlewares;

use Closure;
use Eyika\Atom\Framework\Http\BaseResponse;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Contracts\MiddlewareInterface;

class TrustProxies implements MiddlewareInterface
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers;

    public function __construct(array|null $proxies = null, int|null $headers = null)
    {
        $this->proxies = $proxies;

        // Default to X-Forwarded-For header
        $this->headers = $headers ?? (Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | 
                                       Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO);
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        // Trust the proxies configured for this application
        $request->setTrustedProxies(
            $this->proxies ?? ['127.0.0.1', 'localhost'], // Default to localhost if no proxies set
            1
        );

        return $next($request);
    }

    /**
     * Set the trusted proxies for this application.
     *
     * @param  array|string|null  $proxies
     * @return $this
     */
    public function setProxies($proxies)
    {
        $this->proxies = $proxies;

        return $this;
    }

    /**
     * Set the headers that should be used to detect proxies.
     *
     * @param  int  $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }
}

// Example usage
// $middleware = new TrustProxies(['192.168.1.1', '192.168.1.2'], Request::HEADER_X_FORWARDED_FOR);
// $middleware->handle($request, function ($req) {
//     // Further processing...
// });
