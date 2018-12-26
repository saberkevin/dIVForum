<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use App\ForumCategory;
use App\ForumThread;
use App\User;
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

    public function threadPage($id){
        $search = null;
        $data = ForumCategory::find($id);
        $threads = null;
        $threads = ForumThread::where('forum_id', $data->forum_id)->paginate(5);
        return view('/forum/thread', compact('data', 'threads', 'search', 'id'));
    }

    public function threadEditPage($id, $thread_id){
        $search = null;
        $data = ForumCategory::find($id);
        $threads = null;
        $threads = ForumThread::where('forum_id', $data->forum_id)->paginate(5);
        $edit = null;
        $edit = ForumThread::find($thread_id);
        return view('/forum/edit-thread', compact('data', 'threads', 'edit', 'search', 'id', 'thread_id'));
    }

    public function searchThread(Request $request, $id){
        $search = null;
        $search = $request->search;
        $data = ForumCategory::find($id);
        $users = User::where('name', 'LIKE', '%'.$search.'%');
        $threads = null;
        $threads = ForumThread::where('forum_id', $data->forum_id)
                                ->where('content', 'LIKE', '%'.$search.'%')
                                ->orWhereIn('user_id', array_pluck($users, 'id'))
                                ->paginate(5);
        return view('/forum/thread', compact('data', 'threads', 'search', 'id'));
    }

    public function addThread(Request $request, $id){
        $request->flash();
        $validator = Validator::make($request->all(),
            [
                'thread_content' => 'required|string|max:255',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $forum = Forum::find($id);

        $thread = new ForumThread();
        $thread->forum_id = $forum->id;
        $thread->user_id = Auth::user()->id;
        $thread->content = $request->thread_content;
        $thread->save();

        return redirect()->back();
    }

    public function updateThread(Request $request, $id, $thread_id){
        $request->flash();
        $validator = Validator::make($request->all(),
            [
                'thread_content' => 'required|string|max:255',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $thread = ForumThread::find($thread_id);
        $thread->content = $request->thread_content;
        $thread->save();

        return redirect()->to(route('view-forum-thread', ['id' => $id]));
    }

    public function deleteThread(Request $request, $thread_id){
        $thread = ForumThread::find($thread_id);
        $thread->delete();

        return redirect()->back();
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
