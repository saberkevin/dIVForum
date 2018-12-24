<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
    public function home()
    {
        return view('layouts/main-layout');
    }

    public function login()
    {
        if(Auth::check()) return redirect('/');
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }
}
