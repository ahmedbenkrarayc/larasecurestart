<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $token = $request->cookie('token');

            if (!$token) {
                return response()->json(['error' => 'Token not found'], Response::HTTP_UNAUTHORIZED);
            }

            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

        }catch(\Exception $e){
            return response()->json(['error' => 'Invalid or expired token'], Response::HTTP_UNAUTHORIZED);
        }
        
        return $next($request);
    }
}
