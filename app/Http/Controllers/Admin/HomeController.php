<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $user = Auth::user();
    //         if (!$user) {
    //             return redirect()->route("admin.login");
    //         }
    //         return $next($request);
    //     });
    // }
    function index(){
        return view("admin.home");
    }
    
    function settings(){
        
        return view("admin.settings");
    }
    

}
