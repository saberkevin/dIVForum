<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumCategory;
use Illuminate\Http\Request;

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
}
