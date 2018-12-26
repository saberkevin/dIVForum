<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumCategory;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(){
        $datas = ForumCategory::paginate(10);
        return view('/master-forum/index', compact('datas'));
    }

    public function close(Request $request, $id){
        $forum = Forum::find($id);
        $forum->status = 'closed';
        $forum->save();

        return redirect()->to(route('master-forum'));
    }

    public function delete(Request $request, $id){
        $forumCategory = ForumCategory::find($id);
        $forum = Forum::find($forumCategory->forum_id);

        $forumCategory->delete();
        $forum->delete();
        return redirect()->to(route('master-forum'));
    }
}
