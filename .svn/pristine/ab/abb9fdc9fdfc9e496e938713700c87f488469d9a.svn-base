<?php

namespace App\Http\Controllers\Admin;

use App\App;
use App\AppFiles;
use App\Download;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Blogger;
use Illuminate\Support\Facades\Storage;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

        //$browser = get_browser(null, true);
        //print_r($browser);
        /*
        $client= new Google_Client();
        $client->setDeveloperKey('AIzaSyB3YjtSSl2S7LiAEgf37kTDQThve0Jmu3Q');
        $client->setClientId('829890882215-e6lf23tgs7uoirtgsa0qf3p93r8v6frl.apps.googleusercontent.com');
        $client->setClientSecret('tbmryXsyeg4dvqDf5K_Mtj5d');
        $client->setRedirectUri(url('admin'));
        //$client->setAccessType('online');
        $client->setScopes(array('https://www.googleapis.com/auth/blogger'));


        $clientlogin_url = "https://www.google.com/accounts/ClientLogin";
        $clientlogin_post = array(
            "accountType" => "HGOOGLE",
            "Email" => "apkplz.com@email.com",
            "Passwd" => "Congloi107",
            "service" => "writely",
            "source" => "your application name"
        );

        // Initialize the curl object
        $curl = curl_init($clientlogin_url);

        // Set some options (some for SHTTP)
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $clientlogin_post);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // Execute
        $response = curl_exec($curl);
        dd($response);


        // Get the Auth string and save it
        preg_match("/Auth=([a-z0-9_-]+)/i", $response, $matches);
        $auth = $matches[1];


        $service = new Google_Service_Blogger($client);

        if (isset($_GET['logout'])) { // logout: destroy token
            unset($_SESSION['token']);
            die('Logged out.');
        }

        if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
            $client->authenticate($_GET['code']);
            $_SESSION['token'] = $client->getAccessToken();
        }

        if (isset($_SESSION['token'])) { // extract token from session and configure client
            $token = $_SESSION['token'];
            $client->setAccessToken($token);
        }

        if (!$client->getAccessToken()) { // auth call to google

            $authUrl = $client->createAuthUrl();
            header("Location: " . $authUrl);
            die;
        }

        $mypost = new \Google_Service_Blogger_Post();
        $mypost->setTitle('this is a test 3 title');
        $mypost->setContent('<b>this</b> is a test 1 content');

        $data = $service->posts->insert('5741192868405851586', $mypost); //post id needs here - put your blogger blog id
        $json = json_encode($data);

        */


        $top_dl = App::orderBy('numDownloads', 'desc')->take(100)->get();
        //$recent_dl = AppFiles::orderBy('lasted_download', 'desc')->with('appversion.app')->take(100)->get();

        $recent_dl = Download::orderBy('created_at', 'desc')->with('appversion', 'app')->take(100)->get();
//        print_r($recent_dl);
//        die;
        $dlToday = Download::whereDate('created_at', '=', Carbon::today()->toDateString())->get();

        $today = Carbon::today();
        $downloads_data = array();
        for($i = 1; $i < 8; $i++){
            $preDay = $today->subDay();
            $getDay = Download::whereDate('created_at', '=', $preDay->toDateString())->get();
            if($getDay){
                $totals = $getDay->count();
            } else {
                $totals = 0;
            }
            $data['day'] = $preDay->toDateString();
            $data['dl'] = $totals;
            $downloads_data[] = $data;

        }

        //$downloads_data = json_encode($downloads_data);
        return view('admin.index', compact('top_dl', 'recent_dl', 'dlToday', 'downloads_data'));
    }
}