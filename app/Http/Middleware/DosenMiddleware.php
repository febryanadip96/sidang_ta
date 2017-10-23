<?php

namespace App\Http\Middleware;

use Closure;

class DosenMiddleware
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
		if ($request->user()->role == 2 || $request->user()->role == 3) {
	        return $next($request);
        }
        return redirect('home');
    }
}
