<?php

namespace App\Http\Controllers\Admin;

use App\AppUser;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends AdminController
{

    protected $defaultPerPage = 10;
    protected $rules = [
        'name' => ['required', 'min:3'],
        'email' => 'required',
        'password' => ['required', 'min:6']
    ];
    protected $messages = [
        'required' => 'Please input data',
        'min' => 'Need to contain at least :min characters',
    ];

    public function index()
    {
        $search = Input::get('search');
        if ($search != '') {
            $users = AppUser::where('id', 'like', '%' . $search . '%')->orwhere('name',
                    'like', '%' . $search . '%')->orwhere('email', 'like',
                    '%' . $search . '%')->orderBy('email', 'asc')->paginate($this->defaultPerPage);
        } else {
            $users = AppUser::orderBy('email', 'asc')->paginate($this->defaultPerPage);
        }

        $users->setPath('user');
        return view('admin.user.index', compact('users'));
    }

    public function getCreate()
    {
        return view('admin.user.create' );
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $dev = Developer::where('slug', str_slug($request->developer))->first();
        if ($dev) {
            $developer_id = $dev->id;
        } else {
            $dev = new Developer();
            $dev->name = $request->developer;
            $dev->slug = str_slug($request->developer);
            $dev->save();
            $developer_id = $dev->id;
        }

        $app = new App();

        $app->name = $request->name;
        if ($request->slug == '') {
            $app->slug = str_slug($request->name);
        } else {
            $app->slug = $request->slug;
        }
        $app->content = $request->contentapp;
        $app->keyword = $request->keyword;
        $app->description = $request->description;
        $app->cat_id = $request->cat_id;
        $app->link = $request->link;
        $app->developer_id = $developer_id;
        $now = Carbon::now();
        $dt = Carbon::parse($now);
        $path = 'images/' . $dt->year . '/' . $dt->month;

        $app->path = $path;
        if (Input::has('featured')) {
            $app->featured = 1;
        } else {
            $app->featured = 0;
        }



        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->slug . '.' . $extension;
            $file_data = File::get($file);

            Storage::put($path . '/300/' . $filename, $file_data);
            Storage::put($path . '/170/' . $filename, $file_data);
            Storage::put($path . '/60/' . $filename, $file_data);
            Image::make(storage_path($path . '/170/' . $filename))->resize(170,
                170)->save();
            Image::make(storage_path($path . '/60/' . $filename))->resize(60, 60)->save();
            $app->image = $filename;
        }
        if ($app->save()) {
            return redirect('admin/app/' . $app->id . '/edit')->with('message',
                    'Done.');
        }
    }

    public function postDelete(Request $request)
    {
        $app = App::find($request->id);
        $app->delete();
        $message = "Okie, Đã Xóa";
        Session::flash('message', $message);
        return "success";
    }

    public function postDeleteAll(Request $request)
    {
        $idArray = $request->ar_id;
        foreach ($idArray as $id) {
            $app = App::find($id);
            $app->delete();
            $message = "Okie, Đã xóa xong";
        }
        return redirect('admin/app')->with('message', $message);
    }

    public function getEdit($id)
    {
        $user = (new AppUser())->getUserDetail($id);
        $referralList = AppUser::where('referred_by', '=', $user->id)->orderBy('created_at',
                'desc')->paginate($this->defaultPerPage);
        return view('admin.user.edit', compact('user', 'referralList'));
    }

    public function getReferral(Request $request, $id)
    {
        $month = $request->month;
        $year = $request->year;
        
        $referralList = AppUser::where('referred_by', '=', $id)->orderBy('created_at',
                'desc')->paginate($this->defaultPerPage);
        return View::make('user.referral_table',
                        array('referralList' => $referralList))->render();
    }

    public function postEdit(Request $request)
    {
        $rulers = ['name' => ['required', 'min:3']];



        $this->validate($request, $rulers, $this->messages);

        $user = AppUser::find($request->id);
        $user->name = $request->name;
        $user->location = $request->location;
        $user->sex = $request->sex;
        $user->birthday = $request->input('birthday-day') . '-' . $request->input('birthday-month') . '-' . $request->input('birthday-year');

        if ($user->save()) {
            return redirect('admin/user/' . $user->id . '/edit')->with('message',
                    'Done.');
        }
    }

    public function postActive(Request $request)
    {
        $table = $request->table;
        $field = $request->field;
        $id = $request->id;
        $status = $request->status;
        if ($status == 0) {
            $pub = 1;
        } else {
            $pub = 0;
        }

        DB::table($table)->where('id', $id)->update([$field => $pub]);

        $data["published"] = icon_active("'$table'", "'$field'", $id, $pub);
        return json_encode($data);
    }

}
