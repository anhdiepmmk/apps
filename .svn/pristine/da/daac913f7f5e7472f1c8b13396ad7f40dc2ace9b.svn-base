@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])



@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-9">

        <div itemscope itemtype="http://schema.org/WebSite" class="visible-xs" style="padding-bottom: 15px">
            <meta itemprop="url" content="{{ url('/') }}"/>
            <form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction"
                  method="get" action="{{ url('search') }}" class="form-inline" role="form">
                <meta itemprop="target" content="{{ url('search') }}={search_term}"/>
                <div class="input-group" style="width: 100%">
                    <input itemprop="query-input" type="text" id="search" name="search_term" placeholder="Enter keyword for search" type="text"
                           class="form-control" style="height: 38px">
                    <span  class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> Search</button>
                    </span>
                </div>
            </form>
        </div>

        <!-- Top Apps -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">New Game Update</h1>
                <ul class="pull-right breadcrumb-right">
                </ul>
            </div>
            @foreach($newgameupdate as $version)
            <?php
            $app = $version->app;
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-2 itemApp">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ $link }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name}}</a></h3>
                        <p class="subCard te"><a href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End Top Apps -->
        @include('home.module.ga')
        <!-- Top Games -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">New App Update</h1>
                <ul class="pull-right breadcrumb-right">
                </ul>
            </div>
            @foreach($newappupdate as $version)
            <?php
            $app = $version->app;
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-2 itemApp">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ $link }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name}}</a></h3>
                        <p class="subCard te"><a href="{{ 'manufacture/'.$app->developer->slug }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End Top Games -->


        <!-- Latest Apps -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Lasted Apps</h1>
                <ul class="pull-right breadcrumb-right">
                    <a class="breadcrumb-more" href="{{ url('new-apps') }}">More <i class="fa fa-angle-double-right"></i></a>
                </ul>
            </div>
            @foreach($latest_apps as $version)
            <?php
            $app = $version->app;
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-2 itemApp">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ $link }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name}}</a></h3>
                        <p class="subCard te"><a href="{{ 'manufacture/'.$app->developer->slug }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End Latest Apps -->

        <!-- Latest Games -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Lasted Games</h1>
                <ul class="pull-right breadcrumb-right">
                    <a class="breadcrumb-more" href="{{ url('new-games') }}">More <i class="fa fa-angle-double-right"></i></a>
                </ul>
            </div>
            @foreach($latest_games as $version)
            <?php
            $app = $version->app;
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-2 itemApp">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ $link }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name}}</a></h3>
                        <p class="subCard te"><a href="{{ 'manufacture/'.$app->developer->slug }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End Latest Games -->

    </div>
    <div class="col-xs-12 col-sm-3">
        <!-- Top Referrals -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Top Referrals</h1>
                
            </div>

            <div class="col-sm-12">
                <table class="table  mt-10">
                    <tr>
                        <th>Names</th>
                        <th>Location</th>
                        <th class="text-right">Qty</th>
                    </tr>
                    <?php foreach($topReferral as $row) { ?>
                    <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->location}}</td>
                        <td class="text-right">{{$row->total_refer}}</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End New Apps -->

        <!-- Top Apps -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Top Apps</h1>
                <ul class="pull-right breadcrumb-right">
                    <a class="breadcrumb-more" href="{{ url('apps') }}">More <i class="fa fa-angle-double-right"></i></a>
                </ul>
            </div>
            @foreach($topapps as $app)
            <?php
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-12 topNew first">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ url($link) }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name }}</a></h3>
                        <p class="subCard te"><a href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End New Apps -->

        <!-- New Games -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Top Games</h1>
                <ul class="pull-right breadcrumb-right">
                    <a class="breadcrumb-more" href="{{ url('games') }}">More <i class="fa fa-angle-double-right"></i></a>
                </ul>
            </div>
            @foreach($topgames as $app)
            <?php
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-12 topNew first">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ url($link) }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name }}</a></h3>
                        <p class="subCard te"><a href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End New Games -->
        <!-- Top 24h -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Top in 24h</h1>
            </div>
            @foreach($topin24h as $download)
            <?php
            $app = $download->appversion->app;
            $cat = \App\Category::find($app->cat_id);
            $link = url('android-apps-games/' . $cat->slug . '/' . $app->slug);
            ?>
            <div class="col-xs-4 col-sm-12 topNew first">
                <div class="thumbnail">
                    <div class="picCard">
                        <a href="{{ url($link) }}" title="{{ $app->name }}">
                            <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                        </a>
                    </div>
                    <div class="caption">
                        <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name }}</a></h3>
                        <p class="subCard te"><a href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
        <!-- End New Games -->

        <div style="margin-bottom: 15px" class="fb-page" data-href="https://www.facebook.com/Unity-App-Studio-1580416192200002/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{ $setting->configs['facebook'] }}"><a href="{{ $setting->configs['facebook'] }}">Apk Earn</a></blockquote></div></div>



    </div>
</div>







<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=853746324651467";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@endsection