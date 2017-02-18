<?php

namespace App\Http\Controllers\Admin;

use App\App;
use App\Category;
use App\Developer;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AppController extends AdminController
{

    protected $rules = [
        'name' => ['required','min:3'],
        'image' => 'image',
        'developer' => 'required',
        'link'  => 'required'
    ];

    protected $messages = [
        'required' => 'Xin hãy nhập dữ liệu',
        'min' => 'Dữ liệu không được ngắn hơn :min ký tự',
        'image' => 'Chỉ được up file ảnh'
    ];

    public function index()
    {
        $search = Input::get('search');
        $vwd = Input::get('vwd');
        if($search != ''){
            $apps = App::where('name','like','%'.$search.'%')->with('category')->with('versions')->orderBy('created_at','desc')->paginate(50);
        } elseif ($vwd > 0){
            $apps = App::where('varieswithdevice',1)->orderBy('created_at', 'desc')->with('category')->with('versions')->paginate(50);
        } else {
            $apps = App::orderBy('created_at', 'desc')->with('category')->with('versions')->paginate(50);
        }

        $apps->setPath('app');
        return view('admin.app.index', compact('apps'));
    }


    public function getCreate()
    {
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        return view('admin.app.create', compact('app','mainCategories'));
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $dev = Developer::where('slug', str_slug($request->developer))->first();
        if($dev){
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
        if($request->slug == ''){
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
                $path = 'images/'.$dt->year.'/'.$dt->month;

        $app->path = $path;
        if(Input::has('featured')){
            $app->featured = 1;
        } else {
            $app->featured = 0;
        }



        if(Input::hasFile('image')){
            $file = Input::file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->slug.'.'.$extension;
            $file_data = File::get($file);

            Storage::put($path.'/300/'.$filename, $file_data);
            Storage::put($path.'/170/'.$filename, $file_data);
            Storage::put($path.'/60/'.$filename, $file_data);
            Image::make(storage_path($path.'/170/'.$filename))->resize(170,170)->save();
            Image::make(storage_path($path.'/60/'.$filename))->resize(60,60)->save();
            $app->image = $filename;

        }
        if($app->save()){
            return redirect('admin/app/'.$app->id.'/edit')->with('message','Done.');
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
        foreach($idArray as $id){
            $app = App::find($id);
            $app->delete();
            $message = "Okie, Đã xóa xong";

        }
        return redirect('admin/app')->with('message',$message);
    }

    public function getEdit($id)
    {
        $app = App::find($id);
        $mainCategories = Category::where('parent_id','=',0)->orderBy('ordering')->get();
        return view('admin.app.edit', compact('app','mainCategories'));
    }

    public function postEdit(Request $request)
    {
        $rulers = ['name' => ['required','min:3'],
                  'image' => 'image'];



        $this->validate($request, $rulers, $this->messages);

        $app = App::find($request->id);
        $app->name = $request->name;
        $app->slug = $request->slug;
        $app->content = $request->contentapp;
        $app->keyword = $request->keyword;
        $app->description = $request->description;
        $app->cat_id = $request->cat_id;

        if(Input::has('featured')){
            $app->featured = 1;
        } else {
            $app->featured = 0;
        }

        if(Input::hasFile('image')){
            $file = Input::file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->slug.'.'.$extension;
            $file_data = File::get($file);

            Storage::put($app->path.'/300/'.$filename, $file_data);
            Storage::put($app->path.'/170/'.$filename, $file_data);
            Storage::put($app->path.'/60/'.$filename, $file_data);
            Image::make(storage_path($app->path.'/170/'.$filename))->resize(170,170)->save();
            Image::make(storage_path($app->path.'/60/'.$filename))->resize(60,60)->save();
            $app->image = $filename;

        }
        if($app->save()){
            return redirect('admin/app/'.$app->id.'/edit')->with('message','Done.');
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