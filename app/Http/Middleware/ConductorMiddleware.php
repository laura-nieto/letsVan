<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConductorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role === 2 || $request->user()->role === 1) {
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
