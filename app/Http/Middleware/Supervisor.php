<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Supervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'supervisor' || auth()->user()->role === 'admin'){
            return $next($request);
        }
        return back();
    }
}
