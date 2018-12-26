<?php

namespace App\Http\Controllers\Auth;

use App\Popularity;
use App\Role;
use App\Rules\EndsWith;
use App\User;
use App\Http\Controllers\Controller;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function addEditPage($id = null)
    {
        $roles = Role::all();
        $routeName = Route::currentRouteName();
        return view('auth/register', compact('roles','routeName', 'id'));
    }

    protected function addUpdateUser(Request $data, $routeName, $id = null)
    {
        $data->flash();

        if(!Auth::check())
        {
            $data->request->add(['role' => 2]);
        }
        else if(Auth::check() && $routeName == 'profileEdit')
        {
            $data->request->add(['role' => Auth::user()->role->role_id]);
            $data->request->add(['agreement' => 1]);
        }
        else $data->request->add(['agreement' => 1]);


        $validator = Validator::make($data->all(),
            [
                'name' => 'required|string|max:255',
                'role' => 'required',
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

        $db = null;

        if($routeName == 'register' || $routeName == 'addUser') $db = new User();
        else if($routeName == 'updateUserPage' || $routeName == 'profileEdit') $db = User::find($id);
        $db->name  = $data->name;
        $db->email = $data->email;
        $db->password = bcrypt($data->password);
        $db->phone = $data->phone;
        $db->gender = $data->gender;
        $db->address = $data->address;
        $db->profile_picture = $imageName;
        $db->birthday = $data->birthday;
        $db->save();

        $dbr = null;
        if($routeName == 'register' || $routeName == 'addUser')
        {
            $dbr = new UserRole();
            $dbr->user_id = $db->id;
        }
        else if($routeName == 'updateUserPage' || $routeName == 'profileEdit') $dbr = UserRole::where('user_id','=',$id)->first();
        $dbr->role_id = $data->role;
        $dbr->save();

        $dbp = null;

        if($routeName == 'register' || $routeName == 'addUser')
        {
            $dbp = new Popularity();
            $dbp->user_id = $db->id;
            $dbp->positive = 0;
            $dbp->negative = 0;
            $dbp->save();
        }

        if($routeName == 'addUser' || $routeName == 'updateUserPage') return redirect()->to(route('masterUser'));
        if($routeName == 'profileEdit') return redirect()->to(route('profilePage', $id));
        return redirect()->to(route('login'));
    }

    public function deleteUser($id){
        $data = User::find($id);
        $data->delete();

        return redirect()->to(route('masterUser'));
    }
}
