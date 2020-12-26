<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Auth_Basic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::onceBasic()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Authentication is Failed. Please login'
            ], 401);
        }
        return $next($request);
    }
}
