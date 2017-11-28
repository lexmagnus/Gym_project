<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::check()){
            if(Auth::user()->isAdmin == '1') // is an admin
            {
                return $next($request); // pass the admin
            }else{
                return redirect('/')->withError('Permission Denied'); // not admin.
            }
        }else{
            return redirect('/login')->withError('Unauthorized.', 401);//not loggin in
        }
    }
}
