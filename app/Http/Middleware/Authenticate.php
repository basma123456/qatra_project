<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->is('marketer_admin') || $request->is('marketer_admin/*'))
                return route('marketer_admin.login');

            if($request->is('marketer') || $request->is('marketer/*')) {
                return route('marketer.login');
            }

            return route('login');
        }
    }
}
