<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NonAuth
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
        if ($request->user()) {
            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}
