<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function masterUserPage()
    {
        $datas = User::paginate(10);
        return view('master-user-view', compact('datas'));
    }
}
