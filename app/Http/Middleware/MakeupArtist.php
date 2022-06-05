<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class makeupArtist
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
        if (Auth::user() &&  Auth::user()->role == 1)
        {
            return $next($request);
        }
        else
        {
            return redirect('/home') -> with('status','You Are Not Allowed To Admin Dashboard');
        }
    }
}
