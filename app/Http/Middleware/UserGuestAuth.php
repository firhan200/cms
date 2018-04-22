<?php

namespace App\Http\Middleware;

use Closure;

class UserGuestAuth
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
        if($request->session()->has('user_id')){
            return Redirect('/');
        }
        return $next($request);
    }
}
