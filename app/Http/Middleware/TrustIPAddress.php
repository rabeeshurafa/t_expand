<?php

namespace App\Http\Middleware;

use Closure;

class TrustIPAddress
{
    public function handle($request, Closure $next)
    {
        // if (env('APP_ENV') == 'production') {
//            if ($request->ip() != '82.213.47.225') abort(401);

        // }

        return $next($request);
    }
}
