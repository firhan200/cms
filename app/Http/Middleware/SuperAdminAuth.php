<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminAuth
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
        if($request->session()->has('cms_admin_type')){
            if($request->session()->get('cms_admin_type')!=1){
                return Redirect('/admin');
            }            
        }
        return $next($request);
    }
}
