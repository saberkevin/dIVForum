<?php

namespace App\Http\Controllers;

class RoutesController extends Controller
{
    public function home()
    {
        return view('layouts/main-layout');
    }

    public function loginPage()
    {
        return view('auth/login');
    }
}
