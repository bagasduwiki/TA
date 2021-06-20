<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Mahasiswa
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
        if(auth()->user()->as == 'mahasiswa'){
            return $next($request);
        }
        return response()->view('errors.403', [], 403);
    }
}