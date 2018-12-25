<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use App\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $search = null;
        $datas = ForumCategory::paginate(5);
        return view('home', compact('datas', 'search'));
    }

    public function search(Request $request){
        $search = $request->search;
        $datas = null;
        if($search != ''){
            $forums = Forum::where('name', 'LIKE', '%'.$search.'%')->get();
            if($forums->count() != 0) {
                $datas = ForumCategory::where('forum_id', array_pluck($forums, 'id'))->paginate(5);
            }
        }
        else{
            $datas = ForumCategory::paginate(5);
        }
        return view('home', compact('datas','search'));
    }

    public function insertPage(){
        $categories = Category::all();
        return view('forum/insert-forum', compact('categories'));
    }

    public function insert(Request $request){
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

        $forum = new Forum();
        $forum->user_id = Auth::user()->id;
        $forum->name = $request->name;
        $forum->description = $request->description;
        $forum->status = 'open';
        $forum->save();

        $forumCategory = new ForumCategory();
        $forumCategory->forum_id = $forum->id;
        $forumCategory->category_id = $request->category;
        $forumCategory->save();

        return redirect()->to(route('home'));
    }
}
