<?php

namespace App\Http\Controllers;

use App\App;
use App\AppFiles;
use App\AppVersion;
use App\Category;
use App\Collection;
use App\Contact;
use App\Developer;
use App\Download;
use App\Page;
use App\Ratting;
use App\SearchTerm;
use App\Setting;
use Carbon\Carbon;
use Facebook\Facebook;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Request as RequestNone;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Google_Client;
use Thujohn\Twitter\Facades\Twitter;

class HomeController extends UserController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $setting = Setting::find(1);
        $route = Route::current();
        $uri = $route->uri();
        if ($uri == '/' || $uri == 'page/{pageslug}' || $uri == 'download-apk/{verslug}' || $uri == 'manufacture/{devslug}') {
            $this->page = 'home';
        } elseif ($uri == 'contact-us') {
            $this->page = 'contact';
        } else {
            if (sizeof($route->parameters()) > 0) {
                $slug1 = $route->parameters()['slug1'];
                $apphome = ['apps', 'new-apps', 'rating-apps'];
                $gamehome = ['games', 'new-games', 'rating-games'];
                if (in_array($slug1, $apphome)) {
                    $this->page = 'apps';
                } elseif (in_array($slug1, $gamehome)) {
                    $this->page = 'games';
                } else {
                    $this->page = 'home';
                }
            } else {
                $this->page = 'home';
            }
        }
        View::share('setting', $setting);
        View::share('home', $this->page);
    }

    public function index()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $topapps = App::whereHas('category',
                function($query) {
                $query->where('parent_id', 1);
            })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();

        $topgames = App::whereHas('category',
                function($query) {
                $query->where('parent_id', 2);
            })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();

        $topappsview = App::whereHas('category',
                function($query) {
                $query->where('parent_id', 1);
            })->with('developer')->orderBy('views', 'desc')->take(18)->get();

        $topgamesview = App::whereHas('category',
                function($query) {
                $query->where('parent_id', 2);
            })->with('developer')->orderBy('views', 'desc')->take(18)->get();

        /*
          $topappsofday = Download::selectRaw('downloads.*, count(app_id) AS count')
          ->where('parent_id', 1)->where('created_at', '>=', Carbon::now()->subDay())->groupBy('app_id')->orderby('count', 'desc')->take(18)->get();

          $topgamesofday = Download::selectRaw('downloads.*, count(app_id) AS count')
          ->where('parent_id', 2)->where('created_at', '>=', Carbon::now()->subDay())->groupBy('app_id')->orderby('count', 'desc')->take(18)->get();


         */

        $topin24h = Download::selectRaw('downloads.*, count(app_id) AS count')
                ->where('created_at', '>=', Carbon::now()->subDay())->groupBy('app_id')->with('appversion.app')->orderby('count',
                'desc')->take(10)->get();

        $latest_apps = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                function($query) {
                $query->whereHas('category',
                    function($query) {
                    $query->where('parent_id', 1);
                });
            })->with('app.developer')->orderBy('publish_at', 'desc')->take(24)->get();

        $latest_games = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                function($query) {
                $query->whereHas('category',
                    function($query) {
                    $query->where('parent_id', 2);
                });
            })->with('app.developer')->orderBy('publish_at', 'desc')->take(24)->get();


        $newappupdate = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                function($query) {
                $query->whereHas('category',
                    function($query) {
                    $query->where('parent_id', 1);
                });
            })->with('app.developer')->orderBy('version_updated', 'desc')->take(18)->get();
        $newgameupdate = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                function($query) {
                $query->whereHas('category',
                    function($query) {
                    $query->where('parent_id', 2);
                });
            })->with('app.developer')->orderBy('version_updated', 'desc')->take(18)->get();

        $isHome = 1;
        
        $topReferral = \App\AppUser::orderBy('total_refer','desc')->take(5)->get();

        return view('home.index',
            compact('topapps', 'topgames', 'latest_apps', 'latest_games',
                'new_app_versions', 'new_game_versions', 'isHome',
                'newappupdate', 'newgameupdate', 'topin24h','topReferral'));
    }

    public function checkAndShow1($slug1)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $parentCategory = Category::where('slug', $slug1)->first();
        if ($parentCategory) {
            $parent_id = $parentCategory->id;
            $topapps = App::whereHas('category',
                    function($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id);
                })->with('developer')->orderBy('numDownloads', 'desc')->paginate(30);

            $topapps->setPath($parentCategory->slug);

            $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
            $category = null;
            if (RequestNone::ajax()) {

                $html = '';
                foreach ($topapps as $app) {
                    //$link = url($parentCategory->slug.'/'.$app->slug);
                    $cat = Category::find($app->cat_id);
                    $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
                    $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                <div class="thumbnail">
                                    <div class="picCard">
                                        <a href="' . $link . '" title=".' . $app->name . '">
                                            <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                        <p class="subCard te"><a href="' . url('manufacture/' . $app->developer->slug) . '">' . $app->developer->name . '</a></p>
                                    </div>
                                </div>
                            </div>';
                }
                $data['html'] = $html;
                $data['currentPage'] = $topapps->currentPage();
                return json_encode($data);

                //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                //return Response::json(view('site.category.category_top', compact('topapps'))->render());
            }
            return view('home.category.category_top',
                compact('topapps', 'parentCategory', 'categories', 'category'));
        }

        $subslug1 = substr($slug1, 4);
        $parentCategory = Category::where('slug', $subslug1)->first();
        if ($parentCategory) {
            $parent_id = $parentCategory->id;
            $new_versions = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                    function($query) use($parent_id) {
                    $query->whereHas('category',
                        function($query) use ($parent_id) {
                        $query->where('parent_id', $parent_id);
                    });
                })->with('app.developer')->orderBy('publish_at', 'desc')->paginate(30);
            $new_versions->setPath($parentCategory->slug);

            $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
            $category = null;
            if (RequestNone::ajax()) {

                $html = '';
                foreach ($new_versions as $version) {
                    $app = $version->app;
                    $cat = Category::find($app->cat_id);
                    $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
                    $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                <div class="thumbnail">
                                    <div class="picCard">
                                        <a href="' . $link . '" title=".' . $app->name . '">
                                            <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                        <p class="subCard te"><a href="' . url('manufacture/' . $app->developer->slug) . '">' . $app->developer->name . '</a></p>
                                    </div>
                                </div>
                            </div>';
                }
                $data['html'] = $html;
                $data['currentPage'] = $new_versions->currentPage();
                return json_encode($data);

                //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                //return Response::json(view('site.category.category_top', compact('topapps'))->render());
            }
            return view('home.category.category_new',
                compact('new_versions', 'parentCategory', 'categories',
                    'category'));
        }

        //Parent Category Rating
        $subslug1 = substr($slug1, 7);
        $parentCategory = Category::where('slug', $subslug1)->first();
        if ($parentCategory) {
            $parent_id = $parentCategory->id;
            $rating_apps = App::whereHas('category',
                    function($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id);
                })->with('developer')->orderBy('rate_value', 'desc')->paginate(30);

            $rating_apps->setPath($parentCategory->slug);

            $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
            $category = null;
            if (RequestNone::ajax()) {

                $html = '';
                foreach ($rating_apps as $app) {
                    //$link = url($parentCategory->slug.'/'.$app->slug);
                    $cat = Category::find($app->cat_id);
                    $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
                    $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                <div class="thumbnail">
                                    <div class="picCard">
                                        <a href="' . $link . '" title=".' . $app->name . '">
                                            <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                        <input type="hidden" class="rating" value="' . $app->rate_value . '" data-filled="rating-selected fa fa-star" data-empty="rating fa fa-star" data-readonly/>

                                    </div>
                                </div>
                            </div>';
                }
                $data['html'] = $html;
                $data['currentPage'] = $rating_apps->currentPage();
                return json_encode($data);

                //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                //return Response::json(view('site.category.category_top', compact('topapps'))->render());
            }
            return view('home.category.category_rating',
                compact('rating_apps', 'parentCategory', 'categories',
                    'category'));
        }

        //Parent Category Featured
        $subslug1 = substr($slug1, 9);
        $parentCategory = Category::where('slug', $subslug1)->first();
        if ($parentCategory) {
            $parent_id = $parentCategory->id;
            //$featuredapps = App::where('featured', 1)->with('developer')->orderBy('views', 'desc')->paginate(30);
            $featuredapps = App::whereHas('category',
                    function($query) use ($parent_id) {
                    $query->where('parent_id', $parent_id);
                })->where('featured', 1)->with('developer')->orderBy('views',
                    'desc')->paginate(30);
            $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
            $category = null;
            if (RequestNone::ajax()) {

                $html = '';
                foreach ($featuredapps as $app) {
                    //$link = url($parentCategory->slug.'/'.$app->slug);
                    $cat = Category::find($app->cat_id);
                    $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
                    $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                <div class="thumbnail">
                                    <div class="picCard">
                                        <a href="' . $link . '" title=".' . $app->name . '">
                                            <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                        <p class="subCard te"><a href="' . url('manufacture/' . $app->developer->slug) . '">' . $app->developer->name . '</a></p>
                                    </div>
                                </div>
                            </div>';
                }
                $data['html'] = $html;
                $data['currentPage'] = $featuredapps->currentPage();
                return json_encode($data);

                //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                //return Response::json(view('site.category.category_top', compact('topapps'))->render());
            }
            return view('site.category.category_featured',
                compact('featuredapps', 'parentCategory', 'categories',
                    'category'));
        }
    }

    public function checkAndShowApp($slug1, $slug2)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $category = Category::where('slug', $slug1)->first();
        if ($category) {
            $url = URL::current();
            $keyword = getKeywords();
            if ($keyword != '') {
                $searchterm = SearchTerm::where('url', $url)->where('keyword',
                        $keyword)->first();
                if ($searchterm) {
                    $searchterm->increment('count');
                } else {
                    $searchterm = new SearchTerm();
                    $searchterm->url = $url;
                    $searchterm->keyword = $keyword;
                    $searchterm->count = 1;
                    $searchterm->save();
                }
            }

            $searchterms = SearchTerm::where('url', $url)->orderBy('count')->get();

            $app = App::where('slug', $slug2)->with('category', 'developer')->first();
            if ($app) {
                $parentCategory = Category::find($category->parent_id);
                $cat_id = $app->cat_id;
                $version = $app->getLastVersion();
                $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                        'desc')->with('appfiles')->get();
                $new_versions_in_cat = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use ($cat_id) {
                        $query->whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        });
                    })->with('app.developer')->orderBy('publish_at', 'desc')->take(10)->get();

                $topapps = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 1);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(12)->get();
                $topgames = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 2);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();


                $url = 'https://play.google.com/store/apps/similar?id=' . $app->com;

                $data_content = _curl($url);
                $html = str_get_html($data_content);
                $items = $html->find("div[class=details] a[class=title]");

                $total = sizeof($items);
                $coms = [];
                for ($i = 0; $i < $total; $i++) {
                    $item = $items[$i];
                    $link_g = $item->href;
                    $link_g = strpos($link_g, 'https://') !== false ? $link_g : 'https://play.google.com' . $link_g;
                    $link_cron2 = explode("?", $link_g);
                    $idLink = explode("=", $link_cron2[1]);
                    $com = $idLink[1];

                    $coms[] = $com;
                }

                $similars = App::whereIn('com', $coms)->orderBy('numDownloads',
                        'desc')->with('developer')->get();

                /*
                  $similars = App::whereHas('category', function($query) use ($cat_id){
                  $query->where('id', $cat_id);
                  })->with('developer')->orderByRaw("RAND()")->take(12)->get();
                 */
                $app->increment('views');
                $this->incrementRating($app);

                return view('home.app.app',
                    compact('app', 'parentCategory', 'category', 'version',
                        'allversion', 'new_versions_in_cat', 'topapps',
                        'topgames', 'similars', 'searchterms'));
            }

            // App Apk Download(non Version)
            $subslug2 = substr($slug2, 0, -4);
            $app = App::where('slug', $subslug2)->with('category', 'developer')->first();
            if ($app) {
                $parentCategory = Category::find($category->parent_id);
                $cat_id = $app->cat_id;
                $version = $app->getLastVersion();
                $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                        'desc')->with('appfiles')->get();
                $new_versions_in_cat = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use ($cat_id) {
                        $query->whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        });
                    })->with('app.developer')->orderBy('publish_at', 'desc')->take(10)->get();

                $topapps = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 1);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();
                $topgames = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 2);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();

                $similars = App::whereHas('category',
                        function($query) use ($cat_id) {
                        $query->where('id', $cat_id);
                    })->with('developer')->orderByRaw("RAND()")->take(12)->get();
                $app->increment('views');
                $this->incrementRating($app);

                return view('home.app.appapk',
                    compact('app', 'parentCategory', 'category', 'version',
                        'allversion', 'new_versions_in_cat', 'topapps',
                        'topgames', 'similars', 'searchterms'));
            }

            // App Apk Download(non Version)
            $subslug2 = substr($slug2, 0, -9);
            $app = App::where('slug', $subslug2)->with('category', 'developer')->first();
            if ($app) {
                $parentCategory = Category::find($category->parent_id);
                $cat_id = $app->cat_id;
                $version = $app->getLastVersion();
                $new_versions_in_cat = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use ($cat_id) {
                        $query->whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        });
                    })->with('app.developer')->orderBy('publish_at', 'desc')->take(10)->get();
                $similars = App::whereHas('category',
                        function($query) use ($cat_id) {
                        $query->where('id', $cat_id);
                    })->with('developer')->orderByRaw("RAND()")->take(10)->get();


                $topapps = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 1);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();
                $topgames = App::whereHas('category',
                        function($query) {
                        $query->where('parent_id', 2);
                    })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();
                return view('home.app.appapkdownload',
                    compact('app', 'version', 'parentCategory', 'category',
                        'new_versions_in_cat', 'similars', 'topapps',
                        'topgames', 'searchterms'));
            }
        }
    }

    public function checkAndShow2($slug1, $slug2)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $parentCategory = Category::where('slug', $slug1)->first();
        if ($parentCategory) {
            //SubCategory
            $category = Category::where('slug', $slug2)->where('parent_id',
                    $parentCategory->id)->first();
            if ($category) {
                $parent_id = $parentCategory->id;
                $topapps = App::where('cat_id', $category->id)->with('developer')->orderBy('numDownloads',
                        'desc')->paginate(30);
                $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
                if (RequestNone::ajax()) {
                    $html = '';
                    foreach ($topapps as $app) {
                        //$link = url($parentCategory->slug.'/'.$app->slug);
                        $link = url('android-apps-games/' . $category->slug . '/' . $app->slug);
                        $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                    <div class="thumbnail">
                                        <div class="picCard">
                                            <a href="' . $link . '" title=".' . $app->name . '">
                                                <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                            <p class="subCard te"><a href="' . url('manufacture/' . $app->developer->slug) . '">' . $app->developer->name . '</a></p>
                                        </div>
                                    </div>
                                </div>';
                    }
                    $data['html'] = $html;
                    $data['currentPage'] = $topapps->currentPage();
                    return json_encode($data);

                    //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                    //return Response::json(view('site.category.category_top', compact('topapps'))->render());
                }
                return view('home.category.category_top',
                    compact('topapps', 'parentCategory', 'categories',
                        'category'));
            }

            //SubCategory New
            $subslug2 = substr($slug2, 4);
            $category = Category::where('slug', $subslug2)->where('parent_id',
                    $parentCategory->id)->first();
            if ($category) {
                $parent_id = $parentCategory->id;
                $cat_id = $category->id;
                $new_versions = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use($cat_id) {
                        $query->where('cat_id', $cat_id);
                    })->with('app.developer')->orderBy('publish_at', 'desc')->paginate(30);
                $new_versions->setPath($parentCategory->slug);
                $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
                if (RequestNone::ajax()) {
                    $html = '';
                    foreach ($new_versions as $version) {
                        $app = $version->app;
                        //$link = url($parentCategory->slug.'/'.$app->slug);
                        $link = url('android-apps-games/' . $category->slug . '/' . $app->slug);
                        $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                    <div class="thumbnail">
                                        <div class="picCard">
                                            <a href="' . $link . '" title=".' . $app->name . '">
                                                <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                            <p class="subCard te"><a href="' . url('manufacture/' . $app->developer->slug) . '">' . $app->developer->name . '</a></p>
                                        </div>
                                    </div>
                                </div>';
                    }
                    $data['html'] = $html;
                    $data['currentPage'] = $new_versions->currentPage();
                    return json_encode($data);

                    //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                    //return Response::json(view('site.category.category_top', compact('topapps'))->render());
                }
                return view('home.category.category_new',
                    compact('new_versions', 'parentCategory', 'categories',
                        'category'));
            }

            //SubCategory Rating
            $subslug2 = substr($slug2, 7);
            $category = Category::where('slug', $subslug2)->where('parent_id',
                    $parentCategory->id)->first();
            if ($category) {
                $parent_id = $parentCategory->id;
                $rating_apps = App::where('cat_id', $category->id)->with('developer')->orderBy('rate_value',
                        'desc')->paginate(30);
                $categories = Category::where('parent_id', $parent_id)->orderBy('ordering')->get();
                if (RequestNone::ajax()) {
                    $html = '';
                    foreach ($rating_apps as $app) {
                        //$link = url($parentCategory->slug.'/'.$app->slug);
                        $link = url('android-apps-games/' . $category->slug . '/' . $app->slug);
                        $html .= '<div class="col-xs-4 col-sm-2 itemApp">
                                    <div class="thumbnail">
                                        <div class="picCard">
                                            <a href="' . $link . '" title=".' . $app->name . '">
                                                <img src="' . asset('storage/' . $app->path . '/170/' . $app->image) . '" alt="' . $app->name . '">
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <h3 class="titleCard te"><a href="' . $link . '" title="' . $app->name . '">' . $app->name . '</a></h3>
                                            <input type="hidden" class="rating" value="' . $app->rate_value . '" data-filled="rating-selected fa fa-star" data-empty="rating fa fa-star" data-readonly/>

                                        </div>
                                    </div>
                                </div>';
                    }
                    $data['html'] = $html;
                    $data['currentPage'] = $rating_apps->currentPage();
                    return json_encode($data);

                    //return Response::json(View::make('site.category.category_top', array('topapps' => $topapps))->render());
                    //return Response::json(view('site.category.category_top', compact('topapps'))->render());
                }
                return view('home.category.category_rating',
                    compact('rating_apps', 'parentCategory', 'categories',
                        'category'));
            }
        }
    }

    public function checkAndShow3($slug1, $slug2, $slug3)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $category = Category::where('slug', $slug1)->first();
        if ($category) {
            $url = URL::current();
            $keyword = getKeywords();
            if ($keyword != '') {
                $searchterm = SearchTerm::where('url', $url)->where('keyword',
                        $keyword)->first();
                if ($searchterm) {
                    $searchterm->increment('count');
                } else {
                    $searchterm = new SearchTerm();
                    $searchterm->url = $url;
                    $searchterm->keyword = $keyword;
                    $searchterm->count = 1;
                    $searchterm->save();
                }
            }

            $searchterms = SearchTerm::where('url', $url)->orderBy('count')->get();

            $app = App::where('slug', $slug2)->with('category', 'developer')->first();
            $parentCategory = Category::find($category->parent_id);
            if ($app) {
                $cat_id = $app->cat_id;
                $version = AppVersion::where('slug', $slug3)->first();
                if ($version && $version->app_id == $app->id) {
                    $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                            'desc')->with('appfiles')->get();
                    $new_versions_in_cat = AppVersion::where('publish_at', '<',
                            $now)->whereHas('app',
                            function($query) use ($cat_id) {
                            $query->whereHas('category',
                                function($query) use ($cat_id) {
                                $query->where('id', $cat_id);
                            });
                        })->with('app.developer')->orderBy('publish_at', 'desc')->take(10)->get();

                    $similars = App::whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        })->with('developer')->orderByRaw("RAND()")->take(10)->get();
                    $topapps = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 1);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();
                    $topgames = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 2);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();
                    $app->increment('views');
                    $this->incrementRating($app);
                    return view('home.app.version',
                        compact('app', 'parentCategory', 'category', 'version',
                            'allversion', 'new_versions_in_cat', 'topapps',
                            'topgames', 'similars', 'searchterms'));
                }

                // Version APK
                $subslug3 = substr($slug3, 0, -4);
                $version = AppVersion::where('slug', $subslug3)->first();
                if ($version && $version->app_id == $app->id) {
                    $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                            'desc')->with('appfiles')->get();
                    $new_versions_in_cat = AppVersion::where('publish_at', '<',
                            $now)->whereHas('app',
                            function($query) use ($cat_id) {
                            $query->whereHas('category',
                                function($query) use ($cat_id) {
                                $query->where('id', $cat_id);
                            });
                        })->with('app.developer')->orderBy('publish_at', 'desc')->take(10)->get();

                    $similars = App::whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        })->with('developer')->orderByRaw("RAND()")->take(10)->get();
                    $topapps = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 1);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();
                    $topgames = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 2);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(14)->get();
                    $app->increment('views');
                    $this->incrementRating($app);
                    return view('home.app.versionapk',
                        compact('app', 'parentCategory', 'category', 'version',
                            'allversion', 'new_versions_in_cat', 'topapps',
                            'topgames', 'similars', 'searchterms'));
                }
                //Version Apk Download
                $subslug3 = substr($slug3, 0, -9);
                $version = AppVersion::where('slug', $subslug3)->first();
                if ($version && $version->app_id == $app->id) {
                    $cat_id = $app->cat_id;
                    $topapps = App::whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();
                    $similars = App::whereHas('category',
                            function($query) use ($cat_id) {
                            $query->where('id', $cat_id);
                        })->with('developer')->orderByRaw("RAND()")->take(12)->get();

                    $topapps = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 1);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();
                    $topgames = App::whereHas('category',
                            function($query) {
                            $query->where('parent_id', 2);
                        })->with('developer')->orderBy('numDownloads', 'desc')->take(10)->get();
                    return view('home.app.versionapkdownload',
                        compact('app', 'version', 'parentCategory', 'category',
                            'topapps', 'topgames', 'similars', 'searchterms'));
                }
            }
        }
    }

    public function showDeveloper($devslug)
    {
        $developer = Developer::where('slug', $devslug)->first();
        if ($developer) {
            $dev_apps = App::where('developer_id', $developer->id)->with('category')->orderBy('views',
                    'desc')->get();
            if ($dev_apps->count() > 1) {
                $rand = rand(0, $dev_apps->count() - 1);
                $rand_app = $dev_apps[$rand];
                $cat_id = $rand_app->category->id;
            } else {
                $cat_id = rand(7, 29);
            }

            $similars = App::whereHas('category',
                    function($query) use ($cat_id) {
                    $query->where('id', $cat_id);
                })->with('developer')->orderByRaw("RAND()")->take(10)->get();
            $hot_apps = App::whereHas('category',
                    function($query) use ($cat_id) {
                    $query->where('id', $cat_id);
                })->with('developer')->orderBy('numDownloads', 'desc')->take(12)->get();

            return view('home.developer',
                compact('dev_apps', 'developer', 'similars', 'hot_apps'));
        }
    }

    public function getNew()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $list_new = AppVersion::where('publish_at', '<', $now)->orderBy('publish_at',
                    'desc')
                ->with(['app' => function($query) {
                        $query->with('developer');
                    }])->paginate(60);
        $list_new->setPath('new.html');
        $title = 'New App';
        return view('site.home.new', compact('list_new', 'title'));
    }

    public function getDownload()
    {

        $top_appfile_dl = AppFiles::orderBy('downloads', 'desc')
                ->with('appversion.app.developer')->paginate(30);
        /*
          $top_appversion_dl = AppVersion::where(function($query){
          $query->with(['appfile'=>function($query){
          $query->select('downloads')->orderBy('downloads','desc');
          }]);
          })->with(['app'=>function($query){
          $query->with('developer');
          }])->paginate(30);
         */
        $top_appfile_dl->setPath('top-download.html');
        $top_app_dl = App::orderBy('numDownloads', 'desc')->with('developer')->paginate(30);
        $top_app_dl->setPath('top-download.html');
        return view('site.home.topdownload',
            compact('top_appfile_dl', 'top_app_dl'));
    }

    public function getFeatured()
    {
        $featured_apps = App::where('featured', 1)->orderBy('views')->with('developer')->paginate(30);
        $featured_apps->setPath('featured.html');

        return view('site.home.featured', compact('featured_apps'));
    }

    public function getCollection()
    {
        $collections = Collection::where('published', 1)->orderBy('ordering')->get();
        return view('site.home.collection', compact('collections'));
    }

    public function showCollection($colslug)
    {
        $collection = Collection::where('slug', $colslug)->first();
        $listapps = App::whereIn('id', $collection->list_app)->get();

        return view('site.home.collection_detail',
            compact('collection', 'listapps'));
    }

    public function showAppDetail($devslug, $appslug, $verslug)
    {
        $verslug = substr($verslug, 0, -4);
        $version = AppVersion::where('slug', $verslug)->with('appfiles')->first();
        $app = App::where('slug', $appslug)->with('category')->first();
        $app->increment('views');
        $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                'desc')->with('appfiles')->get();
        $developer = Developer::where('slug', $devslug)->first();
        $parent_category = Category::find($app->category->parent_id);
        return view('site.app.appdetail',
            compact('developer', 'app', 'version', 'parent_category',
                'allversion'));
    }

    public function postRating(Request $request)
    {
        $app_id = $request->app_id;
        $rate = $request->rate;
        $ip = get_client_ip();

        $checkRate = Ratting::where('app_id', $app_id)->where('ip', $ip)->first();
        if (!$checkRate) {
            $rating = new Ratting();
            $rating->app_id = $app_id;
            $rating->ip = $ip;
            $rating->rate_point = $rate;
            $rating->save();
        } else {
            $checkRate->rate_point = $rate;
            $checkRate->save();
        }

        $total_rate = Ratting::where('app_id', $app_id)->get();
        ;
        $rate_count = $total_rate->count();
        $total_point = $total_rate->sum('rate_point');
        $rate_value = round($total_point / $rate_count, 1);

        $app = App::find($app_id);
        $app->rate_count = $rate_count;
        $app->rate_value = $rate_value;
        $app->save();
        $data["error"] = 0;
        $data["msg"] = "Thank you for rating!";
        $data['total_rate'] = $rate_count;
        $data['total_point'] = $total_point;
        $data['value'] = $rate_value;
        $data["txt_msg"] = "Rate: " . $data["value"] . " star - Total: " . $data["total_rate"];
        $data['per'] = ($rate_value * 100) / 5;

        return json_encode($data);
    }

    public function showApp($devslug, $appslug)
    {
        $category = Category::where('slug', $appslug)->first();

        if ($category) {
            $catid = $category->id;
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $newversions = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use ($catid) {
                        $query->where('cat_id', $catid);
                    })->orderBy('publish_at', 'desc')
                    ->with('app.developer')->paginate(30);

            $newversions->setPath($appslug . '.html');
            $topCatdl = App::where('cat_id', $category->id)->orderBy('numDownloads',
                    'desc')->paginate(30);
            $topCatdl->setPath($appslug . '.html');

            $parent_category = Category::find($category->parent_id);

            return view('site.category.catdetail',
                compact('parent_category', 'category', 'newversions', 'topCatdl'));
        } else {
            $app = App::where('slug', $appslug)->with('category')->first();

            if ($app) {

                $ip = long2ip(rand(0, "4294967295"));
                $rating = new Ratting();
                $rating->app_id = $app->id;
                $rating->ip = $ip;
                $rating->rate_point = rand(4, 5);
                $rating->save();

                $total_rate = Ratting::where('app_id', $app->id)->get();
                ;
                $rate_count = $total_rate->count();
                $total_point = $total_rate->sum('rate_point');
                $rate_value = round($total_point / $rate_count, 1);

                $app->rate_count = $rate_count;
                $app->rate_value = $rate_value;
                $app->save();


                $app->increment('views');
                $version = $app->getLastVersion();
                $allversion = AppVersion::where('app_id', $app->id)->orderBy('publish_at',
                        'desc')->with('appfiles')->get();
                $developer = Developer::where('slug', $devslug)->first();
                $parent_category = Category::find($app->category->parent_id);

                $url = 'https://play.google.com/store/apps/similar?id=' . $app->com;
                $data_content = _curl($url);
                $html = str_get_html($data_content);
                $items = $html->find("div[class=details] a[class=title]");

                $total = sizeof($items);
                $coms = [];
                for ($i = 0; $i < $total; $i++) {
                    $item = $items[$i];
                    $link_g = $item->href;
                    $link_g = strpos($link_g, 'https://') !== false ? $link_g : 'https://play.google.com' . $link_g;
                    $link_cron2 = explode("?", $link_g);
                    $idLink = explode("=", $link_cron2[1]);
                    $com = $idLink[1];

                    $coms[] = $com;
                }

                $similars = App::whereIn('com', $coms)->orderBy('numDownloads',
                        'desc')->with('developer')->get();

                return view('site.app.app',
                    compact('developer', 'app', 'parent_category', 'allversion',
                        'version', 'similars'));
            }
        }
    }

    public function showDevorCat($devslug)
    {
        $category = Category::where('slug', $devslug)->first();
        if ($category) {
            $childCat = Category::where('parent_id', $category->id)->get(['id']);
            $listIds = array();
            foreach ($childCat as $row) {
                $listIds[] = $row['id'];
            }
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $newversions = AppVersion::where('publish_at', '<', $now)->whereHas('app',
                        function($query) use ($listIds) {
                        $query->whereIn('cat_id', $listIds);
                    })->orderBy('publish_at', 'desc')
                    ->with('app.developer')->paginate(30);

            $newversions->setPath($devslug . '.html');
            $topCatdl = App::whereIn('cat_id', $listIds)->orderBy('numDownloads',
                    'desc')->paginate(30);
            $topCatdl->setPath($devslug . '.html');
            $parent_category = null;

            return view('site.category.catdetail',
                compact('parent_category', 'category', 'newversions', 'topCatdl'));
        } else {
            $developer = Developer::where('slug', $devslug)->first();
            if ($developer) {
                $apps = App::where('developer_id', $developer->id)->get();
                return view('site.app.developer', compact('developer', 'apps'));
            }
        }
    }

    public function showDownloadPage($appslug, $verslug)
    {
        $version = AppVersion::where('slug', $verslug)->with('appfiles',
                'app.developer')->first();
        $app = $version->app;
        $category = Category::find($app->cat_id);
        $parent_category = Category::find($category->parent_id);
        $developer = $app->developer;

        return view('site.app.downloadpage',
            compact('version', 'app', 'category', 'parent_category', 'developer'));
    }

    public function showDownloadApk($verslug)
    {
        $version = AppVersion::where('slug', $verslug)->with('appfiles', 'app')->first();
        $app = $version->app;

        return view('site.app.downloadapk', compact('app', 'version'));
    }

    public function postReport(Request $request)
    {
        $version = AppVersion::find($request->version_id);
        $version->increment('report');
        $now = Carbon::now()->format('Y-m-d H:i:s');
        ;
        $version->report_at = $now;
        $version->save();
    }

    public function postDownloadApk(Request $request)
    {
        $appfile = AppFiles::where('version_id', $request->version_id)->with('appversion.app')->first();
        $now = Carbon::now()->format('Y-m-d H:i:s');
        ;
        $appfile->lasted_download = $now;
        $appfile->save();

        $reader = new Reader(storage_path() . '/GeoLite2-Country.mmdb');
        $ip = get_client_ip();
        $country = $reader->country($ip);

        $countryCode = $country->country->isoCode;
        $countryName = $country->country->name;

        $checkDL = Download::where('ipaddress', $ip)->where('version_id',
                $appfile->appversion->id)->first();
        if (!$checkDL) {
            $appfile->increment('downloads');
            $appfile->appversion->app->increment('numDownloads');

            $dl = new Download();
            $dl->ipaddress = $ip;
            $dl->version_id = $appfile->appversion->id;
            $dl->app_id = $appfile->appversion->app->id;
            $cat_id = $appfile->appversion->app->cat_id;
            $parent_id = Category::find($cat_id)->parent_id;
            $dl->parent_id = $parent_id;
            $dl->country_code = $countryCode;
            $dl->country_name = $countryName;
        }


        if ($appfile->filesize > 0) {
            if (!$checkDL) {
                $dl->server = $appfile->server;
                $dl->save();
            }


            if ($appfile->srv == 1) {
                $filename = $appfile->filename;
                if ($appfile->obb == 1) {
                    $newname = str_replace('.zip', '-apkearn.com.zip', $filename);
                } else {
                    $newname = str_replace('.apk', '-apkearn.com.apk', $filename);
                }

                $dlink = 'http://download.apkearn.com/' . $appfile->filepath . '/' . $newname;
                return redirect($dlink);
            } else {
                $response = new StreamedResponse();
                $response->setCallback(function() use ($appfile) {
                    echo Storage::disk('dropbox')->get($appfile->filepath . '/' . $appfile->filename);
                });
                $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                    $appfile->filename);
                $response->headers->set('Content-Disposition', $disposition);

                return $response;

                $path = '/' . $appfile->filepath . '/' . $appfile->filename;
                $client = Storage::disk($appfile->server)->getAdapter()->getClient();
                $dl = $client->createTemporaryDirectLink($path);

                return redirect($dl[0]);
            }
        } else {
            if (!$checkDL) {
                $dl->server = 'playstore';
                $dl->save();
            }
            return redirect('https://play.google.com/store/apps/details?id=' . $appfile->appversion->app->com);
        }
        //$content = Storage::disk('dropbox')->get($appfile->filepath.'/'.$appfile->filename);
        //return (new Response($content, 200))->header('Content-Type', 'application/vnd.android.package-archive');
    }

    public function showDownloadGoogle($verslug)
    {
        $version = AppVersion::where('slug', $verslug)->with('app')->first();
        return redirect($version->app->link);
    }

    public function getSearch()
    {
        $keyword = Input::get('search_term');
        $appResult = App::where('name', 'like', '%' . $keyword . '%')->orWhere('com',
                $keyword)->orderBy('views', 'desc')->with('developer')->get();

        if ($appResult->count() > 0) {
            $rand = rand(0, $appResult->count() - 1);
            $rand_app = $appResult[$rand];
            $cat_id = $rand_app->category->id;
        } else {
            $cat_id = rand(7, 29);
        }

        $similars = App::whereHas('category',
                function($query) use ($cat_id) {
                $query->where('id', $cat_id);
            })->with('developer')->orderByRaw("RAND()")->take(10)->get();
        $hot_apps = App::whereHas('category',
                function($query) use ($cat_id) {
                $query->where('id', $cat_id);
            })->with('developer')->orderBy('numDownloads', 'desc')->take(12)->get();

        return view('home.home.search',
            compact('appResult', 'keyword', 'similars', 'hot_apps'));
    }

    public function showPage($pageslug)
    {
        $page = Page::where('slug', $pageslug)->first();
        return view('home.home.page', compact('page'));
    }

    public function showContactPage()
    {
        return view('home.home.contact_us');
    }

    public function postContactPage(Request $request)
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'min:3'],
            'g-recaptcha-response' => ['required', 'captcha']
        ];

        $this->validate($request, $rules);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->reason = $request->reason;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();

        return redirect('contact-us')->with('message',
                'Your message was sent successfully. Thanks');
    }

    public function sitemap()
    {
        $sitemap = app("sitemap");
        $sitemap->addSitemap(url('sitemap-app.xml'));
        $sitemap->addSitemap(url('sitemap-app-apk.xml'));
        $sitemap->addSitemap(url('sitemap-download.xml'));
        $sitemap->addSitemap(url('sitemap-version.xml'));
        $sitemap->addSitemap(url('sitemap-version-apk.xml'));
        $sitemap->addSitemap(url('sitemap-version-download.xml'));
        $sitemap->addSitemap(url('sitemap-developer.xml'));
        $sitemap->addSitemap(url('sitemap-category.xml'));
        $sitemap->addSitemap(url('sitemap-page.xml'));

        return $sitemap->render('sitemapindex');
    }

    public function sitemapApp()
    {
        $sitemap_apps = app("sitemap");
        $sitemap_apps->setCache('apk.sitemap-app', 3600);
        $apps = App::orderBy('created_at', 'desc')->with('category')->get();
        foreach ($apps as $app) {
            $sitemap_apps->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug),
                $app->updated_at, '1.0', 'daily');
        }
        return $sitemap_apps->render('xml');
    }

    public function sitemapAppApk()
    {
        $sitemap_apps = app("sitemap");
        $sitemap_apps->setCache('apk.sitemap-app-apk', 3600);
        $apps = App::orderBy('created_at', 'desc')->with('category')->get();
        foreach ($apps as $app) {
            $sitemap_apps->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug . '-apk'),
                $app->updated_at, '1.0', 'daily');
        }
        return $sitemap_apps->render('xml');
    }

    public function sitemapDownload()
    {
        $sitemap_apps = app("sitemap");
        $sitemap_apps->setCache('apk.sitemap-apk-download', 3600);
        $apps = App::orderBy('created_at', 'desc')->with('category')->get();
        foreach ($apps as $app) {
            $lastVersion = $app->getLastVersion();
            if ($lastVersion) {
                $sitemap_apps->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug . '-download'),
                    $app->updated_at, '1.0', 'daily');
            }
        }
        return $sitemap_apps->render('xml');
    }

    public function sitemapVersion()
    {
        $sitemap_version = app("sitemap");
        $sitemap_version->setCache('apk.sitemap-version', 3600);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $versions = AppVersion::where('publish_at', '<', $now)->orderBy('publish_at',
                'desc')->with('app.category')->get();
        foreach ($versions as $version) {
            $app = $version->app;
            $sitemap_version->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug . '/' . $version->slug),
                $version->publish_at, '0.9', 'daily');
        }
        return $sitemap_version->render('xml');
    }

    public function sitemapVersionApk()
    {
        $sitemap_version = app("sitemap");
        $sitemap_version->setCache('apk.sitemap-version-apk', 3600);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $versions = AppVersion::where('publish_at', '<', $now)->orderBy('publish_at',
                'desc')->with('app.category')->get();
        foreach ($versions as $version) {
            $app = $version->app;
            $sitemap_version->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug . '/' . $version->slug . '-apk'),
                $version->publish_at, '0.9', 'daily');
        }
        return $sitemap_version->render('xml');
    }

    public function sitemapVersionDownload()
    {
        $sitemap_version_download = app("sitemap");
        $sitemap_version_download->setCache('apk.sitemap-version-download', 3600);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $versions = AppVersion::where('publish_at', '<', $now)->orderBy('publish_at',
                'desc')->with('app.category')->get();
        foreach ($versions as $version) {
            $app = $version->app;
            $sitemap_version_download->add(url('android-apps-games/' . $app->category->slug . '/' . $app->slug . '/' . $version->slug . '-download'),
                $version->publish_at, '0.9', 'daily');
        }
        return $sitemap_version_download->render('xml');
    }

    public function sitemapDeveloper()
    {
        $sitemap_developer = app('sitemap');
        $sitemap_developer->setCache('apk.sitemap-developer', 3600);
        $developers = Developer::all();
        foreach ($developers as $dev) {
            $sitemap_developer->add(url('manufacture/' . $dev->slug), null,
                '0.8', 'daily');
        }
        return $sitemap_developer->render('xml');
    }

    public function sitemapCategory()
    {
        $sitemap_category = app("sitemap");
        $sitemap_category->setCache('apk.sitemap-category', 3600);
        $mainCats = Category::where('parent_id', 0)->orderBy('ordering')->get();
        foreach ($mainCats as $cat) {
            $sitemap_category->add(url($cat->slug), null, '0.7', 'daily');
            $sitemap_category->add(url('new-' . $cat->slug), null, '0.7',
                'daily');
            $sitemap_category->add(url('rating-' . $cat->slug), null, '0.7',
                'daily');

            $childs = Category::where('parent_id', $cat->id)->get();
            foreach ($childs as $child) {
                $sitemap_category->add(url($cat->slug . '/' . $child->slug),
                    null, '0.7', 'daily');
                $sitemap_category->add(url($cat->slug . '/new-' . $child->slug),
                    null, '0.7', 'daily');
                $sitemap_category->add(url($cat->slug . '/rating-' . $child->slug),
                    null, '0.7', 'daily');
            }
        }
        return $sitemap_category->render('xml');
    }

    public function sitemapPage()
    {
        $sitemap_page = app("sitemap");
        $sitemap_page->setCache('apk.sitemap-page', 3600);
        $pages = Page::all();
        $sitemap_page->add(url('/'), null, '0.7', 'daily');
        $sitemap_page->add(url('contact-us'), null, '0.7', 'daily');
        foreach ($pages as $page) {
            $sitemap_page->add(url('page/' . $page->slug), null, '0.7', 'daily');
        }
        return $sitemap_page->render('xml');
    }

    public function incrementRating($app)
    {
        $ip = long2ip(rand(0, "4294967295"));
        $rating = new Ratting();
        $rating->app_id = $app->id;
        $rating->ip = $ip;
        $rating->rate_point = rand(4, 5);
        $rating->save();

        $total_rate = Ratting::where('app_id', $app->id)->get();
        ;
        $rate_count = $total_rate->count();
        $total_point = $total_rate->sum('rate_point');
        $rate_value = round($total_point / $rate_count, 1);

        $app->rate_count = $rate_count;
        $app->rate_value = $rate_value;
        $app->save();
    }

    public function cronFacebook()
    {
        $facebook = Setting::findOrNew(2)->configs;
        $fb = new Facebook([
            'app_id' => $facebook['app_id'],
            'app_secret' => $facebook['app_secret'],
        ]);

        $fb->setDefaultAccessToken($facebook['access_token']);
        try {
            $response = $fb->get('/' . $facebook['page_admin'] . '/accounts');
            $page_token = $response->getDecodedBody()['data'][0]['access_token'];

            $now = Carbon::now()->format('Y-m-d H:i:s');
            $version = AppVersion::where('publish_at', '<', $now)->where('post_fb',
                    0)->orderBy('publish_at', 'desc')->with('app.category')->first();

            $versions = AppVersion::where('app_id', $version->app_id)->get();
            if ($versions->count() > 1) {
                $prefix = '[UPDATE]';
            } else {
                $prefix = '[NEW]';
            }
            $app = $version->app;
            $category = $app->category;
            $parentCategory = Category::find($category->parent_id);

            $link = url('android-apps-games/' . $category->slug . '/' . $app->slug);
            $image = asset('storage/' . $app->path . '/170/' . $app->image);
            $hagtag = str_replace("-", "", $app->slug);
            if ($parentCategory->id == 1) {
                $parentTag = '#androidapps #apkdownloads #' . str_replace("-",
                        "", $category->slug) . ' #apkearn';
            } else {
                $parentTag = '#androidgames #apkdownloads #' . str_replace("-",
                        "", $category->slug) . ' #apkearn';
            }
            $args = array(
                'message' => $prefix . ' ' . $app->name . ' ' . $version->name . ' apk download for android

                #' . $hagtag . ' ' . $parentTag,
                'name' => $app->name . ' ' . $version->name . ' apk download for android',
                'description' => 'Download free apk ' . $app->name . ' ' . $version->name . ' with direct link. Fast and Simple',
                'link' => $link,
                'picture' => $image,
                'actions' => json_encode(array(
                    'name' => 'See Pic',
                    'link' => $image
                ))
            );

            $post = $fb->post('/' . $facebook['page_id'] . '/feed', $args,
                $page_token);
            if ($post->getHttpStatusCode() == 200) {
                $version->post_fb = 1;
                $version->save();
                $page_post_id = $post->getDecodedBody()['id'];

                $like = $fb->post('/' . $page_post_id . '/likes', array(),
                    $page_token);
                $user_post = $fb->post('/me/feed', $args);
                $user_post_id = $user_post->getDecodedBody()['id'];
                $like_post = $fb->post('/' . $user_post_id . '/likes');
            }
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }

    public function getLogin()
    {
        return view('home.login');
    }

    public function getRegister()
    {
        return view('home.register');
    }

    public function getAppRequest()
    {
        return view('home.home.apprequest');
    }

}
