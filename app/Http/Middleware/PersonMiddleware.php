<?php

namespace App\Http\Middleware;

use Closure;

class PersonMiddleware
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
        if(session('uid')){
            return $next($request);
        }else{
            return redirect('/auth/login');
        }
    }
}
