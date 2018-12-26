<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use App\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index(){
        $datas = ForumCategory::paginate(10);
        return view('/master-forum/index', compact('datas'));
    }

    public function myForumPage(){
        $user_id = Auth::user()->id;
        $forums = Forum::where('user_id', $user_id)->get();
        $datas = ForumCategory::whereIn('forum_id', array_pluck($forums, 'id'))->paginate(5);
        return view('/forum/my-forum', compact('datas'));
    }

    public function editPage($id){
        $categories = Category::all();
        $data = ForumCategory::find($id);
        return view('/forum/edit-forum', compact('data', 'categories','id'));
    }

    public function update(Request $request, $id){
        $request->flash();
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'category' => 'required',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $forum = Forum::find($id);
        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->save();

        $forumCategory = ForumCategory::find($forum->id);
        $forumCategory->category_id = $request->category;
        $forumCategory->save();

        return redirect()->to(route('my-forum'));
    }

    public function close(Request $request, $id){
        $forum = Forum::find($id);
        $forum->status = 'closed';
        $forum->save();

        return redirect()->back();
    }

    public function delete(Request $request, $id){
        $forumCategory = ForumCategory::find($id);
        $forum = Forum::find($forumCategory->forum_id);

        $forumCategory->delete();
        $forum->delete();
        return redirect()->to(route('master-forum'));
    }
}
