<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class ActivityMiddleware
{
    /**
     * Проверяем авторизизацию пользователя, добавляем в кеш данные о пользователе.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if(auth()->check()){
            $data = [
                'ip'   => $request->ip(),
                'time' => Carbon::now()
            ];

            // Записываем в кеш
            cache([auth()->user()->getCacheKey() => $data], 60);
       }

       return $next($request);
    }
}
