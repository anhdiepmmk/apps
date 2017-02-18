@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])



@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <!-- Top Apps -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left">Top Apps Views</h1>
                    <ul class="pull-right breadcrumb-right">
                    </ul>
                </div>
                @foreach($topappsview as $app)
                    <?php
                        $cat = \App\Category::find($app->cat_id);
                        $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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
                    <h1 class="pull-left">Top Games Views</h1>
                    <ul class="pull-right breadcrumb-right">
                    </ul>
                </div>
                @foreach($topgamesview as $app)
                    <?php
                        $cat = \App\Category::find($app->cat_id);
                        $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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
                        $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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
                        $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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


            <!-- Top Apps -->
               <div class="nborder">
                   <div class="breadcrumbs">
                       <h1 class="pull-left">Popular Apps</h1>
                   </div>
                   @foreach($topapps as $app)
                       <?php
                           $cat = \App\Category::find($app->cat_id);
                            $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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
                       <h1 class="pull-left">Popular Games</h1>
                   </div>
                   @foreach($topgames as $app)
                       <?php
                        $cat = \App\Category::find($app->cat_id);
                        $link = url('android-apps-games/'.$cat->slug.'/'.$app->slug);
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

            <div style="margin-bottom: 15px" class="fb-page" data-href="https://www.facebook.com/Unity-App-Studio-1580416192200002" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{ $setting->configs['facebook'] }}"><a href="{{ $setting->configs['facebook'] }}">Apk Earn</a></blockquote></div></div>



        </div>
    </div>







<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1200970193263843";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@endsection