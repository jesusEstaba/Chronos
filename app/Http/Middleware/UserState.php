<?php

namespace Cronos\Http\Middleware;

use Closure;
use Auth;

class UserState
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
        if (Auth::user()->state == 0) {
            return redirect('login');
        }
        return $next($request);
    }
}
