<?php

namespace App\Http\Middlewares;

use Closure;
use Exception;
use Eyika\Atom\Framework\Http\BaseResponse;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Support\Facade\Encrypter;
use Eyika\Atom\Framework\Http\Contracts\MiddlewareInterface;
use Eyika\Atom\Framework\Http\Cookie;

class EncryptCookies implements MiddlewareInterface
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected array $except = [
        'PHPSESSID', // Add other session-related cookies here
        'XSRF-TOKEN', // Example: CSRF token cookie
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return BaseResponse
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        try {
            // Decrypt incoming request cookies
            $this->decryptCookies($request);
        
            // Process the request and get the response
            $response = $next($request);
        
            // Ensure `$response` is a valid `BaseResponse` object
            if (!$response instanceof BaseResponse) {
                throw new \UnexpectedValueException('Middleware expects a BaseResponse instance.');
            }

            // Encrypt cookies in the response
            $this->encryptCookies($response);

            // Return the processed response
            return $response;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Decrypt cookies in the request.
     *
     * @param Request $request
     * @return void
     */
    protected function decryptCookies(Request $request): void
    {
        $request->cookies()->each(function (string $name, Cookie $cookie) use ($request) {
            if ($this->isDisabled($name)) {
                return;
            }

            $cookie = $cookie->withValue($this->decrypt($cookie->getValue()));
            $request->cookies()->set($name, $cookie);
        });
    }

    /**
     * Encrypt cookies in the response.
     *
     * @param BaseResponse $response
     * @return void
     */
    protected function encryptCookies(BaseResponse $response): void
    {
        $response->cookies()->each(function (string $name, Cookie $cookie) use ($response) {
            if ($this->isDisabled($name)) {
                return;
            }

            $cookie->withValue($this->encrypt($cookie->getValue()));
            $response->setCookie(
                $cookie->withValue($cookie)
            );
        });
    }

    /**
     * Determine if the cookie should not be encrypted.
     *
     * @param string $name
     * @return bool
     */
    protected function isDisabled(string $name): bool
    {
        return in_array($name, $this->except, true);
    }

    /**
     * Encrypt a value.
     *
     * @param string $value
     * @return string
     */
    protected function encrypt(string $value): string
    {
        try {
            return Encrypter::encrypt($value);
        } catch (Exception $e) {
            return $value;
        }
    }

    /**
     * Decrypt a value.
     *
     * @param string $value
     * @return mixed
     */
    protected function decrypt(string $value): mixed
    {
        try {
            return Encrypter::decrypt($value);
        } catch (Exception $e) {
            return $value;
        }
    }
}
