<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends AdminController
{

    protected $rules = [
        'name' => ['required','min:3']
    ];

    protected $messages = [
        'required' => 'Xin hãy nhập dữ liệu',
        'min' => 'Dữ liệu không được ngắn hơn :min ký tự'
    ];

    public function index()
    {
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        return view('admin.category.index',compact('mainCategories'));
    }

    public function getCreate()
    {
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        return view ('admin.category.create', compact('mainCategories'));
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $category = new Category();
        $category->name = $request->name;
        if($request->slug == ''){
            $category->slug = str_slug($request->name);
        } else {
            $category->slug = $request->slug;
        }
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->keyword = $request->keyword;
        if($request->ordering == ''){
            $count = Category::where('parent_id','=',$request->parent_id)->get()->count();
            $category->ordering = $count + 1;
        } else {
            $category->ordering = $request->ordering;
        }
        $category->link = $request->link;
        $category->save();
        return redirect('admin/category')->with('message','Okie');
    }

    public function getEdit($id)
    {
        $category = Category::find($id);
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        return view('admin.category.edit', compact('category','mainCategories'));
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $category = Category::find($request->id);
        $category->name = $request->name;
        if($request->slug == ''){
            $category->slug = str_slug($request->name);
        } else {
            $category->slug = $request->slug;
        }
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->keyword = $request->keyword;
        if($request->ordering == ''){
            $count = Category::where('parent_id','=',$request->parent_id)->get()->count();
            $category->ordering = $count + 1;
        } else {
            $category->ordering = $request->ordering;
        }
        $category->link = $request->link;
        $category->save();
        return redirect('admin/category')->with('message','Okie');
    }

    public function postDelete(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        $message = "Okie, Đã Xóa";
        Session::flash('message', $message);
        return "success";
    }

    public function postReorder(Request $request)
    {
        $order_ids = $request->order_ids;
        $order_positions = $request->order_positions;
        foreach($order_ids as $index => $id){
            $category = Category::find($id);
            $category->ordering = $order_positions[$index];
            $category->save();
        }
        $message = "Okie !";
        Session::flash('message', $message);
        return "success";
    }
}
