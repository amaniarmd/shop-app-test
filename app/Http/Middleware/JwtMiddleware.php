<?php

namespace App\Http\Middleware;

use App\Enums\CommonFields;
use App\Enums\CommonOutputMessages;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
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
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([CommonFields::STATUS => CommonOutputMessages::TOKEN_INVALID], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([CommonFields::STATUS => CommonOutputMessages::TOKEN_EXPIRED], 401);
            } else {
                return response()->json([CommonFields::STATUS => CommonOutputMessages::TOKEN_NOT_FOUND], 401);
            }
        }

        return $next($request);
    }
}
