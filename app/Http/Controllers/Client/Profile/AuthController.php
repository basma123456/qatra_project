<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('client.profile.auth.login');
    }

    public function register(){
        return view('client.profile.auth.register');
    }

    public function logout(){
        auth('user')->logout();
        return redirect(route('client.home'));
    }
}
