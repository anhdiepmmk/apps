<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\AdminController;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends AdminController
{

    protected $rules = [
        'title' => ['required','min:3']
    ];

    protected $messages = [
        'required' => 'Xin hãy nhập dữ liệu',
        'min' => 'Dữ liệu không được ngắn hơn :min ký tự'
    ];

    public function index()
    {
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

    public function getCreate()
    {
        return view ('admin.page.create');
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $page = new Page();
        $page->title = $request->title;
        if($request->slug == ''){
            $page->slug = str_slug($request->title);
        } else {
            $page->slug = $request->slug;
        }
        $page->content = $request->noidung;
        $page->save();
        return redirect('admin/pages')->with('message','Okie');
    }

    public function getEdit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }

    public function postEdit(Request $request)
    {

        $this->validate($request, $this->rules, $this->messages);

        $page = Page::find($request->id);
        $page->title = $request->title;
        if($request->slug == ''){
            $page->slug = str_slug($request->title);
        } else {
            $page->slug = $request->slug;
        }
        $page->content = $request->noidung;
        $page->save();
        return redirect('admin/pages')->with('message','Save Done');
    }

    public function postDelete(Request $request)
    {
        $page = Page::find($request->id);
        $page->delete();
        $message = "Okie, Đã Xóa";
        Session::flash('message', $message);
        return "success";
    }


}
