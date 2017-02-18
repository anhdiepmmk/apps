@extends('home.master')

@if($category == null)
    @section('title', 'New Android '.$parentCategory->name.' Apk Download - Apps.com.mm')
    @section('description', 'Download newest android '.$parentCategory->name.' apk for free')
    @section('keywords', 'new apk, newest apk, new android '.$parentCategory->name.' apk, newest android '.$parentCategory->name.' apk, new releases, download new '.$parentCategory->name)
@else
    @section('title', 'New Android '.$category->name.' '.$parentCategory->name.' Apk Download - Apps.com.mm')
    @section('description', 'Download newest android '.$category->name.' '.$parentCategory->name.' apk for free')
    @section('keywords', 'new apk, newest apk, new android '.$category->name.' '.$parentCategory->name.' apk, newest android '.$category->name.' '.$parentCategory->name.' apk, new releases, download new '.$category->name.' '.$parentCategory->name)
@endif


@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <!-- Top Apps -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left centermobile">Latest {{ $category->name or '' }} {{ $parentCategory->name }}</h1>
                    <ul class="pull-right breadcrumb-right centermobile">
                        <div class="btn-group">
                        @if($category == null)
                            <a href="{{ url($parentCategory->slug) }}" class="btn-u btn-u-default">Top</a>
                            <a href="{{ url('new-'.$parentCategory->slug) }}" class="btn-u">Latest</a>
                            <a href="{{ url('rating-'.$parentCategory->slug) }}" class="btn-u btn-u-default">Rating</a>
                        @else
                            <a href="{{ url($parentCategory->slug.'/'.$category->slug) }}" class="btn-u btn-u-default">Top</a>
                            <a href="{{ url($parentCategory->slug.'/new-'.$category->slug) }}" class="btn-u">Latest</a>
                            <a href="{{ url($parentCategory->slug.'/rating-'.$category->slug) }}" class="btn-u btn-u-default">Rating</a>
                        @endif


                        </div>
                    </ul>
                </div>
                @foreach($new_versions as $version)
                    <?php
                        $app = $version->app;
                        $link = url('android-apps-games/'.$app->category->slug.'/'.$app->slug);
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
                @include('home.module.ga')
                <div id="loadmore"></div>
                <input id="currentPage" type="hidden" value="1">
                <div class="clearfix"></div>
                <div class="text-center" style="padding-bottom: 5px;">
                    <button class="btn btn-default" onclick="getPosts()" type="button">Show More</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- End Top Apps -->



        </div>
        <div class="col-xs-12 col-sm-3">
            <!-- Category -->
            @include('home.module.category')
            <!-- Category -->
        </div>
    </div>



<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

</script>



<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1200970193263843";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@endsection