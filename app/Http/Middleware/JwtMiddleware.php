<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Traits\Api\ApiResponder;

class JwtMiddleware
{
    use ApiResponder;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException){
                return $this->errorResponse('Token is Invalid', 403);
            }else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException){
                return $this->errorResponse('Token is Expired', 401);
            }else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException){
                return $this->errorResponse('Token is Blacklisted', 400);
            }else {
                return $this->errorResponse('Authorization Token not found', 404);
            }
        }
        return $next($request);
    }
}
