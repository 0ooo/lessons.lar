<?php

namespace App\Http\Middleware;

use Closure;

class StatisticsMiddleware
{
    /**
     * Сбор статистики о посещаемости страниц сайта.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (cache()->has('stat')) {
            $data = cache('stat');

            if (array_key_exists($request->path(), $data)) {
                $data[$request->path()]++;
            } else {
                $data[$request->path()] = 1;
            }

        } else {
            $data = [$request->path() => 1];
        }

        cache(['stat' => $data], 1440);

        return $next($request);
    }
}
