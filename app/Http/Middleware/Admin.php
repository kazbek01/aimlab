<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if ((Auth::user()->role_id < 8 && Auth::user()->role_id != 1) || Auth::user()->role_id > 12) {
            Auth::logout();
            return redirect('/');
        }

        if(date('Y-m-d', strtotime(Auth::user()->last_login_date)) != date('Y-m-d') )
        {
            Auth::user()->last_login_date = date('Y-m-d H:i');
            Auth::user()->save();
        }

        return $next($request);
    }
}
