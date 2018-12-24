<?php

namespace App\Http\Controllers\Auth;

use App\Rules\EndsWith;
use App\Rules\OlderThan;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected function createUser(Request $data)
    {
        $data->flash();
        $validator = Validator::make($data->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:mtr_users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'address' => ['required', 'string', new EndsWith('Street')],
                'profile_picture' => 'required|mimes:jpeg,png,jpg',
                'birthday' => 'required|date|before:-12 years',
                'agreement' => 'accepted'
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $imageName = "";

        if($data->hasFile('profile_picture'))
        {
            $image = $data->file('profile_picture');
            $imageName = time().'-'.$image->getClientOriginalName();
            $imagePath = 'profile_picture/';
            $image->move($imagePath,$imageName);
        }

        $db = new User();
        $db->name  = $data->name;
        $db->email = $data->email;
        $db->password = bcrypt($data->password);
        $db->phone = $data->phone;
        $db->gender = $data->gender;
        $db->address = $data->address;
        $db->profile_picture = $imageName;
        $db->birthday = $data->birthday;
        $db->save();

        return redirect()->to('/');
    }
}
