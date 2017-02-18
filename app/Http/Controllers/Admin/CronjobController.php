<?php

namespace App\Http\Controllers\Admin;

use App\App;
use App\AppFiles;
use App\AppVersion;
use App\Category;
use App\Developer;
use App\Http\Controllers\AdminController;
use App\Http\NHelpers\autokeyword;
use Carbon\Carbon;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CronjobController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getCronOne()
    {


        /* $path = '/media/m/us/music-mp3-player-1-1-1.apk';
         $client = Storage::disk('dropbox')->getAdapter()->getClient();
         $dl = $client->createTemporaryDirectLink($path);
         dd($dl);

         $client = Storage::disk('dropbox')->getAdapter()->getClient();
         $url = 'http://192.99.147.48/apk3/M00/01/EE/wGOTMFXN5EOAWVDDA9BiTfj0YP809.xapk?fn=My%20Talking%20Tom_v2.7_apkpure.com.xapk&k=3062eea816ce3189fcbd8f8bd7e3bb9155ea6201&p=com.outfit7.mytalkingtomfree&c=GAME_CASUAL';
         $upload = $client->uploadRemote($url, '/test/com/game.xapk');
         $job_id = $upload['job'];

         $status = $client->uploadRemoteStatus($job_id)['status'];
         while($status == 'PENDING' || $status == 'DOWNLOADING'){
             $status = $client->uploadRemoteStatus($job_id)['status'];
         }
         */
        //$size = Storage::disk('dropbox')->size('com/ea/gp/fifaworld/fifa-16-ultimate-team-2-0-102647.zip');
        //dump($size);

        /*
        $content = Storage::get('a.txt');
        Storage::disk('srv')->put('a.txt', $content);

        */

        $mainCategories = Category::where('parent_id', '=', 0)->orderBy('ordering')->get();
        return view('admin.cronjob.one', compact('mainCategories'));
    }

    public function postCronOne(Request $request)
    {
        $cat_id = $request->cat_id;
        $link = $request->link;
        $data = $this->cronOne($cat_id, $link);
        echo json_encode($data);
    }

    public function getCronJob()
    {

        $mainCategories = Category::where('parent_id', '=', 0)->orderBy('ordering')->get();
        return view('admin.cronjob.all', compact('mainCategories'));
    }

    public function postCronJob()
    {
        $list_link = session('list_link');
        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $data = $this->cronJobCat($link_cron);
            Session::put('list_link', $list_link);
            $link_done = session('link_done');
            $link_done = $link_done + 1;
            Session::put('link_done', $link_done);
            $percentjobs = round(($link_done * 100) / session('total_link'));
            $data['percentjob'] = $percentjobs;
        }
        return $data;
    }

    private function cronJobCat($link)
    {
        $cat = Category::where('link', $link)->first();
        //$post_google["start"] = session('random');
        $post_google["start"] = rand(20, 1000);
        $post_google["num"] = 5;
        $post_google["numChildren"] = 0;
        $post_google["ipf"] = 1;
        $post_google["xhr"] = 1;
        $url = $link . '?hl=en?authuser=0';
        $data_content = postPage($url, $post_google);
        $html = str_get_html($data_content);
        $items = $html->find("div[class=details] a[class=title]");
        for ($i = 0; $i < 5; $i++) {
            $item = $items[$i];
            $link_g = $item->href;
            $link_g = strpos($link_g, 'https://') !== false ? $link_g : 'https://play.google.com' . $link_g;
            $link_cron2 = explode("?", $link_g);
            $idLink = explode("=", $link_cron2[1]);
            $com = $idLink[1];

            $this->cronOne($cat->id, $com);
        }
        $data['msg'] = "Lấy bài viết cho Danh Mục: <strong style='color: blue'>" . $cat->name . "</strong> xong";
        return $data;
    }

    public function postCronSession(Request $request)
    {
        $cat_id = $request->cat_id;
        if ($cat_id == 0) {
            $list_cat = Category::where('link', '!=', '')->get();
            foreach ($list_cat as $index => $row) {
                $list_link[] = $row->link;
            }
        } else {
            $cat = Category::find($cat_id);
            $list_link[] = $cat->link;
        }
        Session::put('list_link', $list_link);
        Session::put('total_link', sizeof(session('list_link')));
        Session::put('link_done', 0);
        Session::forget('random');
        Session::put('random', rand(20, 1000));
        $data['status'] = 1;
        return $data;
    }


    private function cronOne($cat_id, $com)
    {
        $link_gg = 'https://play.google.com/store/apps/details?id=' . $com;
        $link = $link_gg . '&hl=en';
        $itemdatas = _curl($link);
        $itemhtml = str_get_html($itemdatas);
        $title = $itemhtml->find("div[class=document-title]", 0)->plaintext;
        $title = trim($title);
        $slug = str_slug($title);
        if ($slug == "") {
            $slug = str_slug(vnit_EncString($title));
        }

        $version = $itemhtml->find('div[itemprop=softwareVersion]', 0);
        $os = $itemhtml->find('div[itemprop=operatingSystems]', 0)->plaintext;
        $os = str_replace(' and up', '', $os);
        if ($version != null) {
            $version = $version->plaintext;
            $version = preg_replace('/\s+/', '', $version);
            $version = trim($version);
        } else {
            $version = '';
        }

        /*
         * Check Apps exit or not.
         * If Not, Get data and insert new Apps
         * If Exit, go to Insert Version
         */

        if (!$this->checkAppExit($com)) {
            // Get data and insert new App
            $images_url = $itemhtml->find("div[class=cover-container] img[0]", 0)->src;
            if ($images_url != '') {
                $find_list_img = $itemhtml->find("img[class=screenshot]");
                $content = '';
                $developer = $itemhtml->find('a[class="document-subtitle primary"] span', 0)->plaintext;

                $content_ = $itemhtml->find("div[class=show-more-content]");
                $content .= $content_[0]->innertext;

                $content_data = strip_tags($content);
                $developer_slug = str_slug($developer);

                if ($this->checkSlugExit($slug)) {
                    //$count = App::where('slug', $slug)->count();
                    $slug = $developer_slug . '_' . $slug;
                } else {
                    $slug = $slug;
                }
                $params['content'] = $content_data; //page content
                //set the length of keywords you like
                $params['min_word_length'] = 5;  //minimum length of single words
                $params['min_word_occur'] = 2;  //minimum occur of single words

                $params['min_2words_length'] = 3;  //minimum length of words for 2 word phrases
                $params['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases
                $params['min_2words_phrase_occur'] = 2; //minimum occur of 2 words phrase

                $params['min_3words_length'] = 3;  //minimum length of words for 3 word phrases
                $params['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases
                $params['min_3words_phrase_occur'] = 2; //minimum occur of 3 words phrase

                $keyword = new AutoKeyword($params, "iso-8859-1");

                // 1 tu
                $keyword_1 = explode(", ", $keyword->parse_words());
                $str_keyword_1 = "";
                for ($i = 0; $i < sizeof($keyword_1); $i++) {
                    if ($i < 4) {
                        $str_keyword_1 .= $keyword_1[$i] . ", ";
                    }
                }
                //2 tu
                $keyword_2 = explode(", ", $keyword->parse_2words());
                $str_keyword_2 = "";
                for ($i = 0; $i < sizeof($keyword_2); $i++) {
                    if ($i < 4) {
                        $str_keyword_2 .= $keyword_2[$i] . ", ";
                    }
                }
                //3 tu
                $keyword_3 = explode(", ", $keyword->parse_3words());
                $str_keyword_3 = "";
                for ($i = 0; $i < sizeof($keyword_3); $i++) {
                    if ($i < 2) {
                        $str_keyword_3 .= $keyword_3[$i] . ", ";
                    }
                }
                $keyword_meta = rtrim($str_keyword_1 . $str_keyword_2 . $str_keyword_3, ", ");




                //Check Developer Exit or Not

                if (!$this->checkDevExit($developer_slug)) {
                    $dev = new Developer();
                    $dev->name = $developer;
                    $dev->slug = $developer_slug;
                    $dev->save();
                    $developer_id = $dev->id;
                } else {
                    $dev = Developer::where('slug', '=', $developer_slug)->first();
                    $developer_id = $dev->id;
                }

                //Create and Insert Images
                //$now = Carbon::now();
                //$dt = Carbon::parse($now);
                //$path = 'images/'.$dt->year.'/'.$dt->month;

                //$pos = strpos($com, '.');
                //$path = 'images/'.substr($com, 0, $pos).'/'.substr($com, $pos+1,1).'/'.substr($com, $pos + 2,2);

                $str_path = str_replace('.', '/', $com);
                $path = 'images/' . $str_path;

                $ext = '.png';
                $filename = $slug . $ext;
                if(substr( $images_url, 0, 2 ) === "//"){
                    $images_url = 'http:'.$images_url;
                }
                $file_data = file_get_contents($images_url);

                // Main Image
                Storage::put($path . '/300/' . $filename, $file_data);
                Storage::put($path . '/170/' . $filename, $file_data);
                Storage::put($path . '/60/' . $filename, $file_data);
                Image::make(storage_path($path . '/170/' . $filename))->resize(170, 170)->save();
                Image::make(storage_path($path . '/60/' . $filename))->resize(60, 60)->save();

                //Thumb Images
                if (count($find_list_img) > 7) {
                    $total_img = 7;
                } else {
                    $total_img = count($find_list_img);
                }
                $thumbs = array();
                for ($j = 0; $j < $total_img; $j++) {
                    $thumb_url = $find_list_img[$j]->src;
                    if(substr( $thumb_url, 0, 2 ) === "//"){
                        $thumb_url = 'http:'.$thumb_url;
                    }
                    $thumb_data = file_get_contents($thumb_url);
                    $thumb_name = $slug . '-' . $j . '.png';
                    Storage::put($path . '/thumbs/' . $thumb_name, $thumb_data);
                    $thumbs[$j] = $thumb_name;

                }

                //Save to Apps db
                $app = new App();
                $app->cat_id = $cat_id;
                $app->developer_id = $developer_id;
                $app->name = $title;
                $app->slug = $slug;

                $app->content = $content;
                $app->path = $path;
                $app->image = $filename;
                //$app->thumbs = json_encode($thumbs);
                $app->thumbs = $thumbs;
                //$app->os = $os;
                //$app->link = $link_gg;
                $app->com = $com;
                $app->keyword = $keyword_meta;
                if ($version == 'Varieswithdevice' || $version == '') {
                    $app->varieswithdevice = 1;
                }
                $app->save();
                $app_id = $app->id;

                if ($version != '' && $version != 'Varieswithdevice') {
                    $what_new_ = $itemhtml->find("div[class=details-section whatsnew] div[class=show-more-container]");
                    $what_new = "";
                    if (isset($what_new_[0])) {
                        $what_new = $what_new_[0]->innertext;
                        $html_what_new = str_get_html($what_new);
                        $html_what_new->find("h1[class=heading]", 0)->outertext = '';
                        $html_what_new->find("div[class=show-more-end]", 0)->outertext = '';
                        $html_what_new->find("button[class=play-button]", 0)->outertext = '';
                        $html_what_new->find("button[class=play-button]", 1)->outertext = '';
                        $what_new = $html_what_new;
                    }
                    $version_publish = $itemhtml->find('div[itemprop="datePublished"]', 0)->plaintext;
                    $version_updated = Carbon::createFromFormat('F d, Y H:i:s', $version_publish . ' 00:00:00');
                    $appversion = new AppVersion();
                    $appversion->name = $version;
                    $appversion_slug = str_replace('.', '-', $version);
                    $appversion->app_id = $app_id;
                    $appversion->slug = $slug . '-' . $appversion_slug;
                    $appversion->what_new = $what_new;
                    $appversion->minos = trim($os);
                    $appversion->version_updated = $version_updated;
                    $appversion->publish_at = $this->getPublishTime();
                    $appversion->save();

                    $appfile = new AppFiles();
                    $appfile->version_id = $appversion->id;
                    $appfile->filename = $appversion->slug . '.apk';
                    //$filepath = 'apk/'.$dt->year.'/'.$dt->month;
                    //$pos = strpos($com, '.');
                    //$filepath = substr($com, 0, $pos).'/'.substr($com, $pos+1,1).'/'.substr($com, $pos + 2,2);

                    $filepath = $str_path = str_replace('.', '/', $com);
                    $appfile->filepath = $filepath;
                    $appfile->server = 'dropbox';
                    $appfile->save();

                    $data["msg"] = "App: <b style='color:blue;'>" . $title . "</b>. Version: " . $version . ' đã được lấy thành công';

                } else {
                    $data["msg"] = "App: <b style='color:blue;'>" . $title . "</b> đã được lấy thành công";
                }
            } else {
                $data['msg'] = "App: <b style='color:blue;'>" . $title . "</b> không tồn tại ảnh";
            }
        } else {
            // App already in DB, insert Version
            $app = App::where('com', $com)->first();

            $checkVersion = AppVersion::where('name', $version)->where('app_id', $app->id);
            if (!$checkVersion->first() && $app->noupdate == 0) {
                if ($version != '' && $version != 'Varieswithdevice') {
                    $what_new_ = $itemhtml->find("div[class=details-section whatsnew] div[class=show-more-container]");
                    $what_new = "";
                    if (isset($what_new_[0])) {
                        $what_new = $what_new_[0]->innertext;
                        $html_what_new = str_get_html($what_new);
                        $html_what_new->find("h1[class=heading]", 0)->outertext = '';
                        $html_what_new->find("div[class=show-more-end]", 0)->outertext = '';
                        $html_what_new->find("button[class=play-button]", 0)->outertext = '';
                        $html_what_new->find("button[class=play-button]", 1)->outertext = '';
                        $what_new = $html_what_new;
                    }
                    $version_publish = $itemhtml->find('div[itemprop="datePublished"]', 0)->plaintext;
                    $version_updated = Carbon::createFromFormat('F d, Y H:i:s', $version_publish . ' 00:00:00');
                    $appversion = new AppVersion();
                    $appversion->name = $version;
                    $appversion_slug = str_replace('.', '-', $version);
                    $appversion_slug = str_slug($appversion_slug);
                    $appversion->app_id = $app->id;
                    $appversion->slug = $slug . '-' . $appversion_slug;
                    $appversion->what_new = $what_new;
                    $appversion->minos = trim($os);
                    $appversion->version_updated = $version_updated;
                    $appversion->publish_at = $this->getPublishTime();
                    $appversion->save();

                    $appfile = new AppFiles();
                    $appfile->version_id = $appversion->id;
                    $appfile->filename = $appversion->slug . '.apk';
                    //$pos = strpos($com, '.');
                    //$filepath = substr($com, 0, $pos).'/'.substr($com, $pos+1,1).'/'.substr($com, $pos + 2,2);
                    $filepath = $str_path = str_replace('.', '/', $com);
                    $appfile->filepath = $filepath;
                    $appfile->server = 'dropbox';
                    $appfile->save();

                    $data["msg"] = "App: <b style='color:blue;'>" . $title . "</b>. Version: " . $version . ' đã được lấy thành công';
                } else {
                    $data["msg"] = "Không thể lấy được Version: <b style='color:blue;'>" . $version . "</b>";
                }
            } else {
                $data["msg"] = "App: <b style='color:color:blue;'>" . $title . "</b> và Version " . $version . " đã có trong hệ thống";
            }

        }
        return $data;
    }

    private function checkAppExit($com)
    {
        $app = App::where('com', $com)->first();
        if ($app) {
            return true;
        } else {
            return false;
        }
    }

    private function checkSlugExit($slug)
    {
        $app = App::where('slug', $slug)->first();

        if ($app) {
            return $app;
        } else {
            return false;
        }
    }


    private function checkDevExit($slug)
    {
        $dev = Developer::where('slug', '=', $slug)->first();
        if ($dev) {
            return true;
        } else {
            return false;
        }
    }

    private function getPublishTime()
    {
        //$lastApp = App::orderBy('created_at','desc')->first();
        //$publishTime = Carbon::createFromFormat('Y-m-d H:i:s', $lastApp->publish_at)->addMinute(rand(5,30));

        $lastVersion = AppVersion::orderBy('publish_at', 'desc');
        if ($lastVersion->first()) {
            $publishTime = Carbon::createFromFormat('Y-m-d H:i:s', $lastVersion->first()->publish_at)->addMinute(rand(1, 5));
        } else {
            $publishTime = Carbon::now();
        }
        return $publishTime->format('Y-m-d H:i:s');
    }


    public function getCronDownload()
    {
        return view('admin.cronjob.download');
    }

    private function downloadEV($package_name)
    {
        $html = file_get_contents("https://apps.evozi.com/apk-downloader/?id=$package_name");
        $pattern = "/\\{packagename:[^\\}]+\\}/";
        preg_match($pattern, $html, $matches);
        $result = $matches[0];
        $pattern = "/(\\b[^:]+):\\s+([^,]+),/";
        preg_match_all($pattern, $result, $matches);
        $t = $matches[2][1];
        $token_name = $matches[1][2];
        $variable_name = $matches[2][2];
        $pattern = "/var\\s+$variable_name\\s*=\\s*'([^']*)'/";
        preg_match($pattern, $html, $matches);
        $token = $matches[1];
        $data = array(
            "packagename" => $package_name,
            "t" => $t,
            $token_name => $token,
            "fetch" => false
        );
        $headers = array(
            'Content-type: application/x-www-form-urlencoded; charset=UTF-8',
            'origin: https://apps.evozi.com',
            "referer: https://apps.evozi.com/apk-downloader/?id=$package_name",
            'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:39.0) Gecko/20100101 Firefox/39.0'

        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($opts);
        $result = @file_get_contents('https://api-apk.evozi.com/download', false, $context);
        if ($result == FALSE) {
            $result = '{"status":"error","data":"file_get_contents failed to open stream: HTTP request failed!"}';
        }
        $result = json_decode($result);

        return $result;
    }

    public function postCronDownloadSession()
    {

        $versions = DB::table('appversions')
            ->join('appfiles', 'appversions.id', '=', 'appfiles.version_id')
            ->join('apps', 'appversions.app_id', '=', 'apps.id')
            ->select('appversions.*', 'appfiles.*', 'apps.com')->where('appfiles.filesize', 0)->orderBy('appversions.id', 'desc')
            ->get();


        $total_versions_nodl = sizeof($versions);
        $data['total'] = $total_versions_nodl;


        foreach ($versions as $row) {
            $list_link[] = $row->com;
            $list_file_id[] = $row->id;
        }

        Session::put('list_dl_link', $list_link);
        Session::put('list_file_id', $list_file_id);
        Session::put('total_versions', sizeof(session('list_dl_link')));
        $next_cron = array_shift($list_link);
        $next_cron_id = array_shift($list_file_id);
        $data['status'] = 1;
        $data['next_cron'] = $next_cron;
        $data['next_cron_id'] = $next_cron_id;
        return $data;
    }

    public function postCronDownload()
    {
        $list_link = session('list_dl_link');
        $list_file_id = session('list_file_id');

        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $file_id = array_shift($list_file_id);
            Session::put('list_dl_link', $list_link);
            Session::put('list_file_id', $list_file_id);

            $data = $this->downloadApk($file_id, $link_cron);
            $data['total_left'] = sizeof($list_link);

            $next_cron = array_shift($list_link);
            $next_cron_id = array_shift($list_file_id);
            $data['next_cron'] = $next_cron;
            $data['next_cron_id'] = $next_cron_id;
            //$data['msg'] = $version_id;

        }
        return $data;
    }

    private function downloadApk2($file_id, $com_google)
    {

        $link = "https://apkpure.com/store/apps/details?id=".$com_google;
        //$link = 'http://congloi.dynu.com/apk/apk.php?com=' . $com_google;
        //$link = 'http://localhost/apk/apk.php?com='.$com_google;

        $itemdatas = _curl($link);
        sleep(20);
        $itemhtml = str_get_html($itemdatas);
        $check_attr_ = $itemhtml->find('a[class=ga da]');
        if ($check_attr_) {
            $link_file = $check_attr_[0]->href;


            $posDRLink = strpos($link_file, 'https://download.apkpure.com/d/');

            $appfile = AppFiles::find($file_id);
            $filename = $appfile->filename;
            $filepath = $appfile->filepath;

            if($posDRLink == false){
                $pos3 = strpos($link_file, ".xapk?");
                if ($pos3 != false) {
                    $filename = str_replace('.apk', '.zip', $filename);
                    $appfile->obb = 1;
                    $appfile->filename = $filename;
                    $appfile->save();
                }

                $client = Storage::disk('dropbox')->getAdapter()->getClient();
                    $upload = $client->uploadRemote($link_file, '/' . $filepath . '/' . $filename);
                    $job_id = $upload['job'];

                    $status = $client->uploadRemoteStatus($job_id)['status'];
                    while ($status == 'PENDING' || $status == 'DOWNLOADING') {
                        $status = $client->uploadRemoteStatus($job_id)['status'];
                    }
                    if ($status == 'COMPLETE') {
                        $size = Storage::disk('dropbox')->size($filepath . '/' . $filename);
                        $appfile->filesize = $size;
                        $appfile->save();

                        if($appfile->obb == 1){
                            $newname = str_replace('.zip', '-apkearn.com.zip', $filename);
                        } else {
                            $newname = str_replace('.apk', '-apkearn.com.apk', $filename);
                        }

                        $exists = Storage::disk('srv')->exists($filepath.'/'.$newname);
                        if($exists == true){
                            Storage::disk('srv')->delete($filepath.'/'.$newname);
                        }

                        $stream = Storage::disk('dropbox')->getDriver()->readStream($appfile->filepath.'/'.$filename);
                        Storage::disk('srv')->put($filepath.'/'.$newname, $stream);
                        $size = Storage::disk('srv')->size($filepath.'/'.$newname);
                        if($size == $appfile->filesize){
                            $appfile->srv = 1;
                            $appfile->save();
                            $data['msg'] = 'Tải thành công App: ' . $appfile->appversion->app->name . '. Version: ' . $appfile->appversion->name . '. File: ' . $newname . ' Size: ' . human_filesize($size);
                        } else {
                            $data['msg'] = 'Có lỗi trong quá trình upload';
                        }
                        $data['downfrom'] = 'apkpure';
                    } else {
                        $data['msg'] = $client->uploadRemoteStatus($job_id)['error'];
                    }
            } else {
                $header = get_headers($link_file);
                sleep(20);
                //$header = file_get_contents($link_file);
                //$header = file_get_contents('http://congloi.dynu.com/apk/apk.php?header=' . $link_file);
                // $header = file_get_contents('http://nhahanghuudat.com.vn/apk/apk.php?header='.$link_file);
                //$header = json_decode($header);
                //$header = get_headers($link_file);
                $url = str_replace('Location: ', 'http:', $header[6]);
                $pos = strpos($url, "https://apkpure.com/error");
                $pos2 = strpos($url, "Content-Disposition: attachment");
                $pos3 = strpos($url, ".xapk?");

                if ($pos === false && $pos2 === false) {
                    //$file_data = file_get_contents($url["url"]);
                    $appfile = AppFiles::find($file_id);
                    $filename = $appfile->filename;
                    $filepath = $appfile->filepath;
                    if ($pos3 != false) {
                        $filename = str_replace('.apk', '.zip', $filename);
                        $appfile->obb = 1;
                        $appfile->filename = $filename;
                        $appfile->save();
                    }

                    $client = Storage::disk('dropbox')->getAdapter()->getClient();
                    $upload = $client->uploadRemote($url, '/' . $filepath . '/' . $filename);
                    $job_id = $upload['job'];

                    $status = $client->uploadRemoteStatus($job_id)['status'];
                    while ($status == 'PENDING' || $status == 'DOWNLOADING') {
                        $status = $client->uploadRemoteStatus($job_id)['status'];
                    }
                    if ($status == 'COMPLETE') {
                        $size = Storage::disk('dropbox')->size($filepath . '/' . $filename);
                        $appfile->filesize = $size;
                        $appfile->save();


                        if($appfile->obb == 1){
                            $newname = str_replace('.zip', '-apkearn.com.zip', $filename);
                        } else {
                            $newname = str_replace('.apk', '-apkearn.com.apk', $filename);
                        }

                        $exists = Storage::disk('srv')->exists($filepath.'/'.$newname);
                        if($exists == true){
                            Storage::disk('srv')->delete($filepath.'/'.$newname);
                        }

                        $stream = Storage::disk('dropbox')->getDriver()->readStream($appfile->filepath.'/'.$filename);
                        Storage::disk('srv')->put($filepath.'/'.$newname, $stream);
                        $size = Storage::disk('srv')->size($filepath.'/'.$newname);
                        if($size == $appfile->filesize){
                            $appfile->srv = 1;
                            $appfile->save();
                            $data['msg'] = 'Tải thành công App: ' . $appfile->appversion->app->name . '. Version: ' . $appfile->appversion->name . '. File: ' . $newname . ' Size: ' . human_filesize($size);
                        } else {
                            $data['msg'] = 'Có lỗi trong quá trình upload';
                        }

                        $data['downfrom'] = 'apkpure';
                    } else {
                        $data['msg'] = $client->uploadRemoteStatus($job_id)['error'];
                    }

                    /*
                    $tempFile = fopen(storage_path().'/tempFile.apk','w');
                    $this->download($url, $tempFile);
                    fclose($tempFile);
                    $file_data = fopen(storage_path().'/tempFile.apk','r');
                    Storage::disk('dropbox')->put($filepath.'/'.$filename, $file_data);
                    //Storage::disk('dropbox')->put($filepath.'/'.$filename, $file_data);
                    $size = Storage::disk('dropbox')->size($filepath.'/'.$filename);
                    $appfile->filesize = $size;
                    $appfile->save();
                    $data['downfrom'] = 'apkpure';
                    $data['msg'] = 'Tải thành công App: '.$appfile->appversion->app->name .'. Version: '.$appfile->appversion->name.'. File: '.$filename.' Size: '.human_filesize($size);

                    */

                } else {
                    $data['msg'] = 'Không tìm thấy link download';
                }
            }



        } else {
            $data['msg'] = 'Không tìm thấy link download';
        }
        $data['app_done'] = $com_google;
        $data['app_done_id'] = $file_id;

        return $data;


    }

    private function downloadApk($file_id, $com_google)
    {


        $link = "https://apkpure.com/store/apps/details?id=".$com_google;
        $itemdatas = _curl($link);
        sleep(10);
        $itemhtml = str_get_html($itemdatas);

        $check_attr_ = $itemhtml->find('a[class=ga da]');

        if ($check_attr_) {
            $link_file = $check_attr_[0]->href;
            $posDRLink = strpos($link_file, 'https://download.apkpure.com/d/');

            $appfile = AppFiles::find($file_id);
            $filename = $appfile->filename;
            $filepath = $appfile->filepath;

            if($posDRLink == false){
                $pos3 = strpos($link_file, ".xapk?");
                if ($pos3 != false) {
                    $filename = str_replace('.apk', '.zip', $filename);
                    $appfile->obb = 1;
                    $appfile->filename = $filename;
                    $appfile->save();
                }



                if($appfile->obb == 1){
                    $newname = str_replace('.zip', '-apkearn.com.zip', $filename);
                } else {
                    $newname = str_replace('.apk', '-apkearn.com.apk', $filename);
                }

                $url = 'http://download.apkearn.com/wget.php';

                $fields = array(
                    'path' => $filepath,
                    'name' => $newname,
                    'url' => urlencode($link_file)
                );

                $fields_string = '';
                foreach($fields as $key=>$value)
                {
                    $fields_string .= $key.'='.$value.'&';
                }
                rtrim($fields_string, '&');

                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close($ch);

                $size = (int)$result;



                if($size < 100000){
                    $data['msg'] = 'Size quá nhỏ, check lại link';
                    $data['app_done'] = $com_google;
                    $data['app_done_id'] = $file_id;
                    return $data;
                } else {
                    $appfile->filesize = $size;
                    $appfile->srv = 1;
                    $appfile->save();

                    $version = AppVersion::find($appfile->version_id);
                    $version->publish_at = Carbon::now()->format('Y-m-d H:i:s');
                    $version->save();

                    $data['msg'] = 'Tải thành công App: ' . $appfile->appversion->app->name . '. Version: ' . $appfile->appversion->name . '. File: ' . $newname . ' Size: ' . human_filesize($size). ' [Direct]';
                }

            } else {
                $data['msg'] = 'Link not available';
                $data['app_done'] = $com_google;
                $data['app_done_id'] = $file_id;
                return $data;
            }

        } else {
            $data['msg'] = 'Không tìm thấy link download';
        }
        $data['app_done'] = $com_google;
        $data['app_done_id'] = $file_id;

        return $data;
    }

    function download($url, $outputFile)
    {
        $inputFile = fopen($url, 'r');
        $bufferSize = 1024 * 1024; // 1MB
        while (!feof($inputFile)) {
            $buffer = fread($inputFile, $bufferSize);
            fwrite($outputFile, $buffer);
        }
        fclose($inputFile);
    }


    public function getCheckVersion()
    {
        $mainCategories = Category::where('parent_id', '=', 0)->orderBy('ordering')->get();
        return view('admin.cronjob.checkversion', compact('mainCategories'));
    }


    public function postCheckVersionSession(Request $request)
    {
        $cat_id = $request->cat_id;
        if ($cat_id == 0) {
            $apps = App::where('varieswithdevice', 0)->where('noupdate',0)->where('jobs', 0)->orderBy('numDownloads', 'desc')->get();
        } else {
            $apps = App::where('varieswithdevice', 0)->where('noupdate',0)->where('cat_id', $cat_id)->where('jobs', 0)->orderBy('numDownloads', 'desc')->get();
        }
        foreach ($apps as $index => $row) {
            $list_link[] = $row->com;
            $list_id[] = $row->id;
        }
        Session::put('list_link', $list_link);
        Session::put('list_id', $list_id);
        Session::put('total_link', sizeof(session('list_link')));
        Session::put('link_done', 0);
        $data['status'] = 1;
        return $data;
    }


    public function postCheckVersion()
    {
        $list_link = session('list_link');
        $list_id = session('list_id');
        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $app_id = array_shift($list_id);
            $data = $this->checkVersion($app_id, $link_cron);
            $app = App::find($app_id);
            $app->jobs = 1;
            $app->save();
            Session::put('list_link', $list_link);
            Session::put('list_id', $list_id);
            $link_done = session('link_done');
            $link_done = $link_done + 1;
            Session::put('link_done', $link_done);
            $percentjobs = round(($link_done * 100) / session('total_link'));
            $data['percentjob'] = $percentjobs;
        }
        return $data;
    }

    private function checkVersion($app_id, $com)
    {
        $last_version = AppVersion::where('app_id', $app_id)->orderBy('version_updated', 'desc')->first();

        if(!$last_version){
            $app = App::find($app_id);
            $data["msg"] = "<b style='color:blue;'>".$app->name."</b>. Không có Version mới";
            return $data;
        }
        $link = 'https://play.google.com/store/apps/details?id=' . $com . '&hl=en';
        $itemdatas = _curl($link);
        $itemhtml = str_get_html($itemdatas);
        $title = $itemhtml->find("div[class=document-title]", 0);
        if ($title != null) {
            $title = $title->plaintext;
        } else {
            $data["msg"] = "<b style='color:blue;'>Error</b>. Không có Version mới";
            return $data;
        }
        $title = trim($title);
        $slug = str_slug($title);
        $version = $itemhtml->find('div[itemprop=softwareVersion]', 0);
        $os = $itemhtml->find('div[itemprop=operatingSystems]', 0)->plaintext;
        $os = str_replace(' and up', '', $os);

        if ($version != null) {
            $version = $version->plaintext;
            $version = preg_replace('/\s+/', '', $version);
            $version = trim($version);
        } else {
            $version = '';
        }
        if ($version != '' && $version != 'Varieswithdevice' && $version != $last_version->name) {
            $what_new_ = $itemhtml->find("div[class=details-section whatsnew] div[class=show-more-container]");
            $what_new = "";
            if (isset($what_new_[0])) {
                $what_new = $what_new_[0]->innertext;
                $html_what_new = str_get_html($what_new);
                $html_what_new->find("h1[class=heading]", 0)->outertext = '';
                $html_what_new->find("div[class=show-more-end]", 0)->outertext = '';
                $html_what_new->find("button[class=play-button]", 0)->outertext = '';
                $html_what_new->find("button[class=play-button]", 1)->outertext = '';
                $what_new = $html_what_new;
            }
            $version_publish = $itemhtml->find('div[itemprop="datePublished"]', 0)->plaintext;
            $version_updated = Carbon::createFromFormat('F d, Y H:i:s', $version_publish . ' 00:00:00');
            $appversion = new AppVersion();
            $appversion->name = $version;
            $version = str_replace('.', '-', $version);
            $appversion_slug = str_slug($version);
            $appversion->app_id = $app_id;
            $appversion->slug = $slug . '-' . $appversion_slug;
            $appversion->what_new = $what_new;
            $appversion->minos = trim($os);
            $appversion->version_updated = $version_updated;
            //$appversion->publish_at = $this->getPublishTime();
            $appversion->publish_at = Carbon::now()->format('Y-m-d H:i:s');
            $appversion->save();

            $appfile = new AppFiles();
            $appfile->version_id = $appversion->id;
            $appfile->filename = $appversion->slug . '.apk';

            //$pos = strpos($com, '.');
            //$filepath = substr($com, 0, $pos) . '/' . substr($com, $pos + 1, 1) . '/' . substr($com, $pos + 2, 2);

            $filepath = str_replace('.','/', $com);
            $appfile->filepath = $filepath;
            $appfile->server = 'dropbox';
            $appfile->save();

            $data["msg"] = "App: <b style='color:blue;'>" . $title . "</b>. Version: " . $version . ' đã được lấy thành công';
        } else {
            $data["msg"] = "App: <b style='color:blue;'>" . $title . "</b>. Không có Version mới";
        }

        return $data;
    }


    public function getCheckVersion2()
    {
        $mainCategories = Category::where('parent_id', '=', 0)->orderBy('ordering')->get();


        return view('admin.cronjob.checkversion2', compact('mainCategories'));
    }

    public function postCheckVersionSession2(Request $request)
    {
        $cat_id = $request->cat_id;
        if ($cat_id == 0) {
            $apps = App::where('varieswithdevice', 1)->where('noupdate',0)->where('jobs', 0)->orderBy('numDownloads', 'desc')->get();
        } else {
            $apps = App::where('varieswithdevice', 1)->where('noupdate',0)->where('cat_id', $cat_id)->where('jobs', 0)->orderBy('numDownloads', 'desc')->get();
        }
        foreach ($apps as $index => $row) {
            $list_link[] = $row->com;
            $list_id[] = $row->id;
        }
        Session::put('list_link', $list_link);
        Session::put('list_id', $list_id);
        Session::put('total_link', sizeof(session('list_link')));
        Session::put('link_done', 0);
        $data['status'] = 1;
        return $data;
    }

    public function postCheckVersion2()
    {
        $list_link = session('list_link');
        $list_id = session('list_id');
        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $app_id = array_shift($list_id);
            $data = $this->checkVersion2($app_id, $link_cron);
            $app = App::find($app_id);
            $app->jobs = 1;
            $app->save();
            Session::put('list_link', $list_link);
            Session::put('list_id', $list_id);
            $link_done = session('link_done');
            $link_done = $link_done + 1;
            Session::put('link_done', $link_done);
            $percentjobs = round(($link_done * 100) / session('total_link'));
            $data['percentjob'] = $percentjobs;
        }
        return $data;
    }

    private function checkVersion2($app_id, $com)
    {
        $last_version = AppVersion::where('app_id', $app_id)->orderBy('version_updated', 'desc')->first();
        $app = App::find($app_id);
        if($last_version){
            $last_version_name = $last_version->name;
        } else {
            $last_version_name = '';
        }
        $link = 'https://play.google.com/store/apps/details?id=' . $com . '&hl=en';
        $link2 = 'https://apkpure.com/store/apps/details?id='.$com;
        $itemdatas2 = _curl($link2);
        $itemhtml2 = str_get_html($itemdatas2);
        $version = $itemhtml2->find('p[itemprop=softwareVersion]', 0);

        if ($version != null) {
            $version = $version->plaintext;
            //$version = preg_replace('/\s+/', '', $version);
            $version = trim($version);
        } else {
            $version = '';
        }


        if($version != '' && $version != $last_version_name){
            $itemdatas = _curl($link);
            $itemhtml = str_get_html($itemdatas);

            $what_new_ = $itemhtml->find("div[class=details-section whatsnew] div[class=show-more-container]");
            $what_new = "";
            if (isset($what_new_[0])) {
                $what_new = $what_new_[0]->innertext;
                $html_what_new = str_get_html($what_new);
                $html_what_new->find("h1[class=heading]", 0)->outertext = '';
                $html_what_new->find("div[class=show-more-end]", 0)->outertext = '';
                $html_what_new->find("button[class=play-button]", 0)->outertext = '';
                $html_what_new->find("button[class=play-button]", 1)->outertext = '';
                $what_new = $html_what_new;
            }

            $os = $itemhtml2->find('p[itemprop=operatingSystem]', 0)->plaintext;
            $os = str_replace(' and up', '', $os);
            $os = str_replace('+', '', $os);
            $os = str_replace('Android', '', $os);
            $os = trim($os);

            $version_publish = $itemhtml2->find('p[itemprop="datePublished"]', 0)->plaintext;
            $version_updated = Carbon::createFromFormat('F d Y H:i:s', $version_publish . ' 00:00:00');
            $slug = $app->slug;
            $appversion = new AppVersion();
            $appversion->name = $version;
            $version_slug = str_replace('.', '-', $version);
            $appversion_slug = str_slug($version_slug);
            $appversion->app_id = $app_id;
            $appversion->slug = $slug . '-' . $appversion_slug;
            $appversion->what_new = $what_new;
            $appversion->minos = trim($os);
            $appversion->version_updated = $version_updated;
            $appversion->publish_at = $this->getPublishTime();
            //$appversion->publish_at = Carbon::now()->format('Y-m-d H:i:s');
            $appversion->save();




            //Update new Image


            $itemdatas_gg = _curl($link);
            $itemhtml_gg = str_get_html($itemdatas_gg);
            $images_check = $itemhtml_gg->find("div[class=cover-container] img[0]", 0);
            $app = App::find($appversion->app_id);
            if($images_check != null) {
                $images_url = $itemhtml->find("div[class=cover-container] img[0]", 0)->src;
                if ($images_url != '') {
                    $str_path = str_replace('.', '/', $com);
                    $path = 'images/' . $str_path;

                    $ext = '.png';
                    $filename = $app->slug . $ext;
                    if (substr($images_url, 0, 2) === "//") {
                        $images_url = 'http:' . $images_url;
                    }
                    $file_data = file_get_contents($images_url);

                    // Main Image
                    Storage::put($path . '/300/' . $filename, $file_data);
                    Storage::put($path . '/170/' . $filename, $file_data);
                    Storage::put($path . '/60/' . $filename, $file_data);
                    Image::make(storage_path($path . '/170/' . $filename))->resize(170, 170)->save();
                    Image::make(storage_path($path . '/60/' . $filename))->resize(60, 60)->save();

                    $url1 = asset('storage/' . $app->path . '/300/' . $filename);
                    $url2 = asset('storage/' . $app->path . '/170/' . $filename);
                    $url3 = asset('storage/' . $app->path . '/60/' . $filename);


                }
            }


            $appfile = new AppFiles();
            $appfile->version_id = $appversion->id;
            $appfile->filename = $appversion->slug . '.apk';
            $filepath = $str_path = str_replace('.', '/', $com);
            $appfile->filepath = $filepath;
            $appfile->server = 'dropbox';
            $appfile->save();


            $data["msg"] = "App: <b style='color:blue;'>" . $app->name . "</b>. Version: " . $version . ' đã được lấy thành công';
        } else {
            $data["msg"] = "App: <b style='color:blue;'>" . $app->name . "</b>. Không có Version mới";
        }
        sleep(15);
        return $data;
    }



    //FPT

    public function getCronDownloadFTP()
    {
        return view('admin.cronjob.downloadftp');
    }
    public function postCronDownloadSessionFTP()
    {


        $appfiles = AppFiles::where('srv', 0)->orderBy('downloads', 'asc')->get();
        foreach($appfiles as $row){
            $list_link[] = $row->filename;
            $list_file_id[] = $row->id;
        }

        Session::put('list_dl_link', $list_link);
        Session::put('list_file_id', $list_file_id);
        Session::put('total_versions', sizeof(session('list_dl_link')));
        $next_cron = array_shift($list_link);
        $next_cron_id = array_shift($list_file_id);
        $data['status'] = 1;
        $data['next_cron'] = $next_cron;
        $data['next_cron_id'] = $next_cron_id;
        return $data;
    }

    public function postCronDownloadFTP()
    {
        $list_link = session('list_dl_link');
        $list_file_id = session('list_file_id');

        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $file_id = array_shift($list_file_id);
            Session::put('list_dl_link', $list_link);
            Session::put('list_file_id', $list_file_id);

            $data = $this->downloadApkFTP($file_id, $link_cron);
            $data['total_left'] = sizeof($list_link);

            $next_cron = array_shift($list_link);
            $next_cron_id = array_shift($list_file_id);
            $data['next_cron'] = $next_cron;
            $data['next_cron_id'] = $next_cron_id;
            //$data['msg'] = $version_id;

        }
        return $data;
    }

    private function downloadApkFTP($file_id, $com_google)
        {

            $appfile = AppFiles::find($file_id);

            $filename = $appfile->filename;

            if($appfile->obb == 1){
                $newname = str_replace('.zip', '-apkearn.com.zip', $filename);
            } else {
                $newname = str_replace('.apk', '-apkearn.com.apk', $filename);
            }

            $filepath = $appfile->filepath;
            $filepath = str_replace('.', '', $filepath);
            $appfile->filepath = $filepath;

            $exists = Storage::disk('srv')->exists($filepath.'/'.$newname);
            if($exists == true){
                Storage::disk('srv')->delete($filepath.'/'.$newname);
            }
            $exists = Storage::disk('dropbox')->exists($filepath.'/'.$filename);
            if($exists == true){
                $stream = Storage::disk('dropbox')->getDriver()->readStream($appfile->filepath.'/'.$filename);
                Storage::disk('srv')->put($filepath.'/'.$newname, $stream);
                $size = Storage::disk('srv')->size($filepath.'/'.$newname);
                if($size == $appfile->filesize){
                    $appfile->srv = 1;
                    $appfile->save();
                    $data['msg'] = 'Tải thành công File: '.$newname .' Size: '.human_filesize($size);
                } else {
                    $data['msg'] = 'Có lỗi trong quá trình upload';
                    $appfile->srv = 1;
                    $appfile->save();
                }
            } else {
                $data['msg'] = 'Dropbox không có file';
                $appfile->srv = 1;
                $appfile->save();
            }


            $data['app_done'] = $com_google;
            $data['app_done_id'] = $file_id;

            return $data;


        }


    // Cron Similar

    public function getCronSimilar(){
        return view('admin.cronjob.downloadsimilar');
    }
    public function postCronSimilarSession()
    {


        $apps = App::where('jobs2', 0)->orderBy('numDownloads', 'desc')->get();

        foreach($apps as $row){
            $list_link[] = $row->com;
            $list_file_id[] = $row->id;
        }


        Session::put('list_link_similar', $list_link);
        Session::put('list_id_similar', $list_file_id);
        Session::put('total_link_similar', sizeof(session('list_link_similar')));
        Session::put('link_done_similar', 0);

        $next_cron = array_shift($list_link);
        $next_cron_id = array_shift($list_file_id);
        $data['status'] = 1;
        $data['next_cron'] = $next_cron;
        $data['next_cron_id'] = $next_cron_id;


        $data['status'] = 1;
        return $data;
    }

    public function postCronSimilar(){
        $list_link = session('list_link_similar');
        $list_file_id = session('list_id_similar');

        if (sizeof($list_link) == 0) {
            $data['jobsleft'] = 0;
        } else {
            $link_cron = array_shift($list_link);
            $file_id = array_shift($list_file_id);
            Session::put('list_link_similar', $list_link);
            Session::put('list_id_similar', $list_file_id);

            $data = $this->getSimilar($file_id, $link_cron);
            $data['total_left'] = sizeof($list_link);

            $next_cron = array_shift($list_link);
            $next_cron_id = array_shift($list_file_id);
            $data['next_cron'] = $next_cron;
            $data['next_cron_id'] = $next_cron_id;
            //$data['msg'] = $version_id;

        }
        return $data;
    }


    private function getSimilar($file_id, $com_google){
        //Find similar app

        $app = App::find($file_id);
        $url = 'https://play.google.com/store/apps/similar?id='.$com_google;

        $data_content = _curl($url);
        $html = str_get_html($data_content);
        $items = $html->find("div[class=details] a[class=title]");

        $c = 0;
        $total = sizeof($items);
        for ($i = 0; $i < $total; $i++) {
            $item = $items[$i];
            $link_g = $item->href;
            $link_g = strpos($link_g, 'https://') !== false ? $link_g : 'https://play.google.com' . $link_g;
            $link_cron2 = explode("?", $link_g);
            $idLink = explode("=", $link_cron2[1]);
            $com = $idLink[1];

            $checkapp = App::where('com', $com)->first();
            if(!$checkapp){
                $check_cat = _curl($link_g);
                $html_cat = str_get_html($check_cat);
                if($html_cat != null){
                    $link_cat = $html_cat->find("a[class=document-subtitle category]");
                    $url_cat = $link_cat[0]->href;

                    $real_url = 'https://play.google.com'.$url_cat.'/collection/topselling_free';
                    $category = Category::where('link', $real_url)->first();
                    $check_price = $html_cat->find("button[class=price buy id-track-click id-track-impression]");
                    if(trim($check_price[0]->plaintext) == 'Install'){
                        $this->cronOne($category->id, $com);
                        $c++;
                    }
                }

            }

        }


        $app->jobs2 = 1;
        $app->save();
        $data['msg'] = 'Tải được '.$c.' apps similar';
        $data['app_done'] = $com_google;
        $data['app_done_id'] = $file_id;

        return $data;
    }

}