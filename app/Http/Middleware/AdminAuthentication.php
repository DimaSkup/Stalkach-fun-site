<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class AdminAuthentication
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
        if ($request->user() && $request->user()->is_admin === true) {
            return $next($request);
        }

        return new RedirectResponse(url('/'));
    }
}
