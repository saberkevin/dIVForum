<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $login_credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $remember = $request->input('remember');

        if(Auth::attempt($login_credentials,$remember)){
            return redirect($this->redirectTo);
        }
        else{
            return redirect()->back()->withErrors('Wrong Email or Password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectTo);
    }
}
