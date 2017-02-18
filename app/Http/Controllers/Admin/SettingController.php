<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\AdminController;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SettingController extends AdminController
{

    public function index()
    {
        $configs = Setting::findOrNew(1)->configs;
        return view('admin.settings.config', compact('configs'));
    }

    public function postSave(Request $request)
    {
        $configs = $request->configs;
        $settings = Setting::findOrNew(1);
        $settings->configs = $configs;
        $settings->save();
        return redirect('admin/settings/config')->with('message','Okie');
    }

}