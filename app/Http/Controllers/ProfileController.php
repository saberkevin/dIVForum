<?php

namespace App\Http\Controllers;

use App\Inbox;
use App\Popularity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profilePage($id)
    {

        $data = User::find($id);
        $routeName = Route::currentRouteName();
        if(!$data)
        {
            return back();
        }

        return view('profile-page/profile-page', compact('data', 'routeName', 'id'));
    }

    protected function vote($id, $voteBoolean)
    {
        $db = Popularity::where('user_id','=',$id)->first();
        if($voteBoolean == 1) $db->positive += 1;
        else if($voteBoolean == 0) $db->negative += 1;
        $db->save();

        return redirect()->to(route('profilePage', $id));
    }

    protected function sendMessage(Request $data, $id)
    {
        $validator = Validator::make($data->all(),
            [
                'message' => 'required|string'
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $db = new Inbox();
        $db->user_id = $id;
        $db->sender_id = Auth::user()->id;
        $db->content = $data->message;
        $db->save();

        return redirect()->to(route('profilePage', $id));
    }
}
