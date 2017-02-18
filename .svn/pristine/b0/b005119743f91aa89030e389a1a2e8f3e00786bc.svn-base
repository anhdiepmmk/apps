<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Contact;
use App\Http\Controllers\AdminController;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends AdminController
{


    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view('admin.contact.index',compact('contacts'));
    }



    public function postDelete(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->delete();
        $message = "Okie, Đã Xóa";
        Session::flash('message', $message);
        return "success";
    }


}
