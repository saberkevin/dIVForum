<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
   public function inboxPage()
   {
       $datas = Inbox::where('user_id', '=', Auth::user()->id)->paginate(10);
       return view('profile-page/inbox-page', compact('datas'));
   }

    public function deleteMessage($id)
    {
        $data = Inbox::find($id);
        $data->delete();

        return redirect()->to(route('inboxPage', ['id' => Auth::user()->id]));
    }
}
