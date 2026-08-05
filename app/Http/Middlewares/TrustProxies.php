<?php

namespace App\Http\Middlewares;

use Closure;
use Eyika\Atom\Framework\Http\BaseResponse;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Contracts\MiddlewareInterface;

class TrustProxies implements MiddlewareInterface
{
    /**
     * Upstream addresses whose X-Forwarded-* headers this app believes.
     *
     * Null means "read config/app.php", which reads TRUSTED_PROXIES and defaults to NONE.
     * Entries may be literal IPs or CIDR blocks.
     *
     * @var array|null
     */
    protected $proxies;

    /**
     * Which forwarded headers to believe a trusted proxy for — a bitmask of
     * Request::HEADER_X_FORWARDED_*.
     *
     * Narrow this if your proxy only sets some of them. A proxy that sets X-Forwarded-For but
     * never X-Forwarded-Host should not be believed for the host, or a client can choose the
     * host your app resolves tenants and generated URLs from.
     *
     * @var int
     */
    protected $headers;

    public function __construct(array|null $proxies = null, int|null $headers = null)
    {
        $this->proxies = $proxies;
        $this->headers = $headers ?? Request::HEADER_X_FORWARDED_ALL;
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        // Defaults to an EMPTY list: nothing upstream is trusted until an operator names it.
        // Do not reintroduce a loopback fallback here — behind LiteSpeed and similar the PHP
        // process commonly sees REMOTE_ADDR=127.0.0.1 for ordinary traffic, so trusting
        // loopback trusts every client, and host()/scheme()/clientIp() all gate on this.
        $request->setTrustedProxies(
            $this->proxies ?? config('app.trusted_proxies', []),
            $this->headers
        );

        return $next($request);
    }

    /**
     * Set the trusted proxies for this application.
     *
     * @param  array|null  $proxies
     * @return $this
     */
    public function setProxies($proxies)
    {
        $this->proxies = $proxies;

        return $this;
    }

    /**
     * Set which forwarded headers to believe a trusted proxy for.
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

// Example: trust a private-range load balancer, but only for the client IP and scheme --
// leaving the Host header untrusted.
//
// $middleware = new TrustProxies(
//     ['10.0.0.0/8'],
//     Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PROTO
// );
