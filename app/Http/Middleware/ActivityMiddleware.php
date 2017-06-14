<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActivityMiddleware
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
        if (Auth::check()) {

            $userInfo = [
                'id' => auth()->id(),
                'ip' => $request->ip(),
                'time' => time()
            ];

            $cacheKey = auth()->user()->getCacheKey();
            cache($cacheKey, $userInfo);

            return $next($request);
        }else{
            redirect()->route('/');
        }
    }
}
