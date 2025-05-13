<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDriverAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(! auth('driver')->check()){
            return redirect()->route('drivers.login');
        }
        if(@auth('driver')->user()->status != 1){
            auth('driver')->logout();
            session()->flash('error' , trans('message.driver.account_not_active') );
            return redirect()->route('drivers.login');
        }
       
        return $next($request);
    
    }
}
