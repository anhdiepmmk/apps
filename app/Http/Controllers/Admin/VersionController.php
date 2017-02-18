<?php

namespace App\Http\Controllers\Admin;

use App\App;
use App\AppFiles;
use App\AppVersion;
use App\Category;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VersionController extends AdminController
{

    public function __construc()
    {
        ini_set('memory_limit', '2048M');
    }
    protected $rules = [
        'name' => ['required','min:3'],
    ];

    protected $messages = [
        'required' => 'Xin hãy nhập dữ liệu',
        'min' => 'Dữ liệu không được ngắn hơn :min ký tự',
        'image' => 'Chỉ được up file ảnh'
    ];

    public function index($id)
    {
        $app = App::find($id);
        $versions = AppVersion::where('app_id', $app->id)->with('appfiles')->orderBy('version_updated', 'desc')->get();
        return view('admin.version.index', compact('app', 'versions'));
    }

    public function getCreate($id){
        $app = App::find($id);
        return view('admin.version.create', compact('app'));
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $app_id = $request->app_id;
        $app = App::find($app_id);
        $slug = str_replace('.','-', $request->name);
        $slug = str_slug($slug);
        $version_slug = $app->slug.'-'.$slug;

        $version = new AppVersion();
        $version->name = $request->name;
        $version->slug = $version_slug;
        $version->app_id = $app_id;
        $version->what_new = $request->what_new;
        $version->minos = $request->minos;
        $version->publish_at = Carbon::now()->format('Y-m-d H:i:s');
        $version->version_updated = Carbon::createFromFormat('Y-m-d H:i:s', $request->version_updated.' 00:00:00');
        $version->save();

        $filename = $version->slug.'.apk';
        //$now = Carbon::now();
        //$dt = Carbon::parse($now);
        //$path = 'apk/'.$dt->year.'/'.$dt->month;
        $com = $app->com;
        //$pos = strpos($com, '.');
        //$path = substr($com, 0, $pos).'/'.substr($com, $pos+1,1).'/'.substr($com, $pos + 2,2);
        $path =  $str_path = str_replace('.','/', $com);
        if(Input::has('apklink')){
            $apklink = $request->apklink;
            //$file_data = file_get_contents($apklink);

            $tempFile = fopen(storage_path().'/tempFile.apk','w');
            $this->download($apklink, $tempFile);
            fclose($tempFile);
            $file_data = fopen(storage_path().'/tempFile.apk','r');
            Storage::disk('dropbox')->put($path.'/'.$filename, $file_data);
            $size = Storage::disk('dropbox')->size($path.'/'.$filename);
            $appfile = new AppFiles();
            $appfile->version_id = $version->id;
            $appfile->server = 'dropbox';
            $appfile->filename = $filename;
            $appfile->filepath = $path;
            $appfile->filesize = $size;
            $appfile->save();
        }
        if(Input::hasFile('apkfile')){
            $apkfile = Input::file('apkfile');
            $file_data = File::get($apkfile);
            Storage::disk('dropbox')->put($path.'/'.$filename, $file_data);
            $size = Storage::disk('dropbox')->size($path.'/'.$filename);
            $appfile = new AppFiles();
            $appfile->version_id = $version->id;
            $appfile->server = 'dropbox';
            $appfile->filename = $filename;
            $appfile->filepath = $path;
            $appfile->filesize = $size;
            $appfile->save();
        }

        if(!Input::has('apklink') && !Input::hasFile('apkfile')){
            $appfile = new AppFiles();
            $appfile->version_id = $version->id;
            $appfile->server = 'dropbox';
            $appfile->filename = $filename;
            $appfile->filepath = $path;
            $appfile->save();
        }


        return redirect('admin/app/'.$request->app_id.'/version')->with('message','Done.');

    }

    public function postDelete(Request $request)
    {
        $app = AppVersion::find($request->id);
        $app->delete();
        $message = "Okie, Đã Xóa";
        Session::flash('message', $message);
        return "success";
    }

    public function postFix(Request $request)
    {
        $version = AppVersion::find($request->id);
        $version->report = 0;
        $version->save();
        $message = "Okie, Đã Fix";
        Session::flash('message', $message);
        return "success";
    }


    public function postDeleteAll(Request $request)
    {
        $idArray = $request->ar_id;
        foreach($idArray as $id){
            $app = AppVersion::find($id);
            $app->delete();
            $message = "Okie, Đã xóa xong";

        }
        return redirect('admin/app')->with('message',$message);
    }

    public function getEdit($id, $version_id)
    {
        $app = App::find($id);
        $version = AppVersion::find($version_id);
        return view('admin.version.edit', compact('app','version'));
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        $version = AppVersion::find($request->version_id);
        $version->name = $request->name;
        $version->what_new = $request->what_new;
        $version->minos = $request->minos;
        $version->version_updated = Carbon::createFromFormat('Y-m-d H:i:s', $request->version_updated.' 00:00:00');
        $version->publish_at = Carbon::now()->format('Y-m-d H:i:s');
        if(Input::has('apklink')){
            $apklink = $request->apklink;
            //$file_data = @file_get_contents($apklink);

            $appfile = AppFiles::where('version_id', $version->id)->first();

            $pos3 = strpos($apklink, ".xapk?");
            if ($pos3 != false) {
                $filename = str_replace('.apk', '.zip', $appfile->filename);
                $appfile->obb = 1;
                $appfile->filename = $filename;
                $appfile->save();
            }

            $client = Storage::disk('dropbox')->getAdapter()->getClient();
            $upload = $client->uploadRemote($apklink, '/'.$appfile->filepath.'/'.$appfile->filename);
            $job_id = $upload['job'];

            $status = $client->uploadRemoteStatus($job_id)['status'];
            while($status == 'PENDING' || $status == 'DOWNLOADING'){
                $status = $client->uploadRemoteStatus($job_id)['status'];
            }
            if($status == 'COMPLETE'){
                $size = Storage::disk('dropbox')->size($appfile->filepath.'/'.$appfile->filename);
                $appfile->filesize = $size;
                $appfile->save();
                $version->report = 0;
            }
            /*$tempFile = fopen(storage_path().'/tempFile.apk','w');
            $this->download($apklink, $tempFile);
            fclose($tempFile);
            $file_data = fopen(storage_path().'/tempFile.apk','r');

            Storage::disk('dropbox')->put($appfile->filepath.'/'.$appfile->filename, $file_data);
            $size = Storage::disk('dropbox')->size($appfile->filepath.'/'.$appfile->filename);
            $appfile->filesize = $size;
            $appfile->save();
            $version->report = 0;*/
        }
        if(Input::hasFile('apkfile')){
            $apkfile = Input::file('apkfile');
            $file_data = File::get($apkfile);
            $appfile = AppFiles::where('version_id', $version->id)->first();
            Storage::disk('dropbox')->put($appfile->filepath.'/'.$appfile->filename, $file_data);
            $size = Storage::disk('dropbox')->size($appfile->filepath.'/'.$appfile->filename);
            $appfile->filesize = $size;
            $appfile->save();
            $version->report = 0;
        }

        if($version->save()){
            return redirect('admin/app/'.$request->app_id.'/version/'.$version->id.'/edit')->with('message','Done.');
        }

    }
    function download($url, $outputFile) {
        $inputFile = fopen($url, 'r');
        $bufferSize = 1024 * 1024; // 1MB
        while (!feof($inputFile)){
           $buffer = fread($inputFile, $bufferSize);
           fwrite($outputFile, $buffer);
        }
        fclose($inputFile);
    }


    public function getNoDownloadLink()
    {

        $versions_nodllink = AppFiles::where('filesize',0)->with(['appversion' => function($query){
            $query->with('app');
        }])->paginate(50);

        return view('admin.version.nodllink', compact('versions_nodllink'));
    }

    public function showReport()
    {
        $versions = AppVersion::where('report','>',0)->orderBy('report_at', 'desc')->with('app','appfiles')->get();
        return view('admin.version.report', compact('versions'));
    }

}