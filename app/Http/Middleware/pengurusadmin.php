<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class pengurusadmin
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
        if(auth()->user()->as == 'pengurus'||'admin'){
            return $next($request);
        }
        abort(403);

    }
}
