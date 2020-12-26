<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class API_Key
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
        $token = $request->header('API_Key');
        if (!isset($token)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'API Key is not found'
            ], 401);
        }
        if ($token !== "ABCDE") {
            return response()->json([
                'status' => 'failed',
                'message' => 'API Key is false'
            ], 401);
        }
        return $next($request);
    }
}
