<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfDonorAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard()->check() && Auth::guard()->user() != null) {
            return redirect(route('client.profile.index'));
        }
        return $next($request);
    }
}
