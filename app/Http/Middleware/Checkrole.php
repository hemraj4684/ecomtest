<?php

namespace App\Http\Middleware;

use Closure, Auth;

class Checkrole
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
        if (Auth::user()->role !== 'admin') {
            abort(401); 
        }
        return $next($request);
    }
}
