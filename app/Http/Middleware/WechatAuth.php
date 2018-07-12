<?php

namespace App\Http\Middleware;

use Closure;

class WechatAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        if ($token) {
            return $next($request);
        } else {
            return response()->json(['code'=>401, 'message'=>'Authenticate Failed']);
        }
    }
}
