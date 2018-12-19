<?php

namespace App\Http\Controllers\Auth;

use App\Rules\EndsWith;
use App\User;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    protected function createUser(Request $data)
    {
        $validator = Validator::make($data->all,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:confirmed',
                'password_confirmation' => 'required|string',
                'phone' => 'required|numeric',
                'gender' => 'required|in:male,female',
                'address' => ['required|string', new EndsWith('Street')],
                'profile_pict' => 'required|mimes:jpeg,png,jpg',
                'birthday' => 'required|date',
                'agree' => 'accepted'
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

    }
}
