<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\VisitorPage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $currentPage = $request->url();

        $visitorId = $request->session()->get('visitor_id');

        if (!$visitorId) {
            $visitor = Visitor::create([
                'ip' => $ip,
                'user_agent' => $userAgent
            ]);
            $request->session()->put('visitor_id', $visitor->id);
        } else {
            $visitor = Visitor::find($visitorId);
        }

        $routeName = Route::currentRouteName();

        $routeNameSegments = explode('.', $routeName);

        VisitorPage::create([
            'visitor_id' => $visitor->id,
            'url' => $currentPage,
            'page' => Arr::last($routeNameSegments),
        ]);

        return $next($request);
    }
}
