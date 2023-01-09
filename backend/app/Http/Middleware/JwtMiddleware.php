<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       $t = new \PHPOpenSourceSaver\JWTAuth\Facades\JWTFactory::emptyClaims();
        try {
            $user = Auth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['message' => 'Token inválido.', 'status' => 401]);
            }else if ($e instanceof PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['message' => 'Token expirado', 'status' => 498]);
            }else{
                return response()->json(['message' => 'Token não encontrado', 'status' => 401]);
            }
        }
        return $next($request);
    }

    /**
     */
    public function __construct() {
    }
}
