<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $datas = null;
        $datas = Category::paginate();
        return view('master-category/index', compact('datas'));
    }

    public function insert(Request $request){
        $request->flash();
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $db = new Category();
        $db->name  = $request->name;
        $db->save();

        return redirect()->to(route('master-category'));
    }

    public function editPage($id){
        return view('master-category/edit-category', compact('id'));
    }

    public function update(Request $request, $id){
        $request->flash();
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $db = Category::find($id);
        $db->name  = $request->name;
        $db->save();

        return redirect()->to(route('master-category'));
    }

    public function delete(Request $request, $id){
        $data = Category::find($id);
        $data->delete();

        return redirect()->to(route('master-category'));
    }
}
