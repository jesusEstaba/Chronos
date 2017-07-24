<?php

namespace Cronos\Http\Middleware;

use Closure;
use Auth;

class OperatorLimit
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
        if (Auth::user()->rol == 0) {
            return redirect('dashboard');
        }
        
        return $next($request);
    }
}
