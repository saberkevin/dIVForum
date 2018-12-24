<?php

namespace App\Http\Controllers;

class RoutesController extends Controller
{
    public function home()
    {
        return view('layouts/main-layout');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }
}
