<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Contact;
use App\Http\Controllers\AdminController;
use App\Page;
use App\Setting;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FacebookController extends AdminController
{


    public function index()
    {
        $facebook = Setting::findOrNew(2)->configs;
        return view('admin.cronjob.facebook', compact('facebook'));
    }

    public function postSaveFacebook(Request $request)
    {
        $facebook = $request->facebook;
        $settings = Setting::find(2);
        $settings->configs = $facebook;
        $settings->save();
        return redirect('admin/facebook')->with('message','Okie');
    }

    public function getFacebookToken()
    {
        //$s = Setting::findOrNew(2)->configs;
        $settings = Setting::find(2);
        $facebook = $settings->configs;

        $app_id = $facebook['app_id'];
        $app_secret = $facebook['app_secret'];
        $my_url = url('admin/facebook/getfbtoken');

        $code = Input::get('code');

        if(empty($code)) {
            // Redirect to Login Dialog
            //$_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
            session()->put('state', md5(uniqid(rand(), TRUE)));

            $dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
               . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
               . session('state') . "&scope=publish_pages,publish_actions,email";


            echo("<script> top.location.href='" . $dialog_url . "'</script>");
        }
        if(session('state') && (session('state') === Input::get('state'))) {
            $token_url = "https://graph.facebook.com/oauth/access_token?"
                . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
                . "&client_secret=" . $app_secret . "&code=" . $code;

            $response = file_get_contents($token_url);
            $params = null;
            parse_str($response, $params);
            $longtoken = $params['access_token'];
            $facebook['access_token'] = $longtoken;
            $settings->configs = $facebook;
            $settings->save();
            return redirect(url('admin/facebook'));
        }
    }




}
