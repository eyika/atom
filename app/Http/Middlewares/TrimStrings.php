<?php

namespace App\Http\Middlewares;

use Closure;
use Eyika\Atom\Framework\Http\BaseResponse;
use Eyika\Atom\Framework\Http\Request;
use Eyika\Atom\Framework\Http\Contracts\MiddlewareInterface;

class TrimStrings implements MiddlewareInterface
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): BaseResponse
    {
        $this->clean($request);

        return $next($request);
    }

    /**
     * Clean the request's data by trimming whitespace.
     *
     * @param Request $request
     * @return void
     */
    protected function clean(Request $request)
    {
        $input = $request->input();
        $query = $request->query();

        $cleanedInput = $this->trimArray($input);
        $cleanedQuery = $this->trimArray($query);

        $request->replaceInput($cleanedInput);
        $request->replaceQuery($cleanedQuery);
    }

    /**
     * Trim all of the values in the array.
     *
     * @param array $data
     * @return array
     */
    protected function trimArray(array $data)
    {
        return array_map(function ($value) {
            if (is_null($value) || is_bool($value) || is_numeric($value))
                return $value;
            return is_array($value) ? $this->trimArray($value) : ( is_string($value) ? trim($value) : $value);
        }, $data);
    }
}
