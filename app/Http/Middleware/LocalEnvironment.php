<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalEnvironment
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (app()->environment('local') === false) {
            return response(null, 404);
        }

        return $next($request);
    }
}
