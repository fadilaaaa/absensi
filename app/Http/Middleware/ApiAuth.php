<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     */
    public function handle(Request $request, Closure $next)
    {

        $bearer = $request->bearerToken();
        $personal_access_token = PersonalAccessToken::findToken($bearer);

        if (!$personal_access_token) {
            return response()->json([
                'message' => 'Unauthorized',
                'token' => $bearer
            ], 401);
        }

        return $next($request)->header('Access-Control-Allow-Origin', '*');
    }
}
