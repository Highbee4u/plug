<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\Api\ApiResponder;

class RateLimiting
{
    use ApiResponder;


    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('rate_limiting.enabled')) {
            $key = $this->resolveRequestSignature($request);

            $maxAttempts = config('rate_limiting.limit');
            $decayMinutes = config('rate_limiting.expires');

            if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
                return $this->showMessage('Too Many Requests', Response::HTTP_TOO_MANY_REQUESTS);
            }

            $this->limiter->hit($key, $decayMinutes);
        }

        return $next($request);
    }

    protected function resolveRequestSignature($request)
    {
        return $request->ip();
    }
}
