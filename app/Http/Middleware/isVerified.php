<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class isVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && !is_null($user->name)) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('user.profile');
        }else{
            $response = [
                'success' => false,
                'message' => "OTP not complated",
            ];
            return response()->json($response, 403);
        }
        
    }
}
