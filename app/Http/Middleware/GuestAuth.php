<?php

namespace App\Http\Middleware;

use Closure;

class GuestAuth
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
        if($request->session()->has('cms_admin_id')){
            return Redirect('/admin/home');
        }
        return $next($request);
    }
}
