@extends('home.master')

@if($category == null)
    @section('title', 'Top Rating Android '.$parentCategory->name.' Apk - Apps.com.mm')
    @section('description', 'Top rating android '.$parentCategory->name.' apk for free')
    @section('keywords', 'top apk, top rating apk, top android '.$parentCategory->name.' apk, top rating android '.$parentCategory->name.' apk, rating '.$parentCategory->name.' apk')
@else
    @section('title', 'Top Rating Android '.$category->name.' '.$parentCategory->name.' Apk - Apps.com.mm')
    @section('description', 'Top rating android '.$category->name.' '.$parentCategory->name.' apk for free')
    @section('keywords', 'top apk, top rating apk, top android '.$category->name.' '.$parentCategory->name.' apk, top rating android '.$category->name.' '.$parentCategory->name.' apk, rating '.$category->name.' '.$parentCategory->name.' apk')
@endif

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <!-- Top Apps -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left centermobile">Top Ratings {{ $category->name or '' }} {{ $parentCategory->name }}</h1>
                    <ul class="pull-right breadcrumb-right centermobile">
                        <div class="btn-group">
                        @if($category == null)
                            <a href="{{ url($parentCategory->slug) }}" class="btn-u btn-u-default">Top</a>
                            <a href="{{ url('new-'.$parentCategory->slug) }}" class="btn-u btn-u-default">Latest</a>
                            <a href="{{ url('rating-'.$parentCategory->slug) }}" class="btn-u">Rating</a>
                        @else
                            <a href="{{ url($parentCategory->slug.'/'.$category->slug) }}" class="btn-u btn-u-default">Top</a>
                            <a href="{{ url($parentCategory->slug.'/new-'.$category->slug) }}" class="btn-u btn-u-default">Latest</a>
                            <a href="{{ url($parentCategory->slug.'/rating-'.$category->slug) }}" class="btn-u">Rating</a>
                        @endif


                        </div>
                    </ul>
                </div>
                @foreach($rating_apps as $app)
                    <?php
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
                                <input type="hidden" class="rating" value="{{ $app->rate_value }}" data-filled="rating-selected fa fa-star" data-empty="rating fa fa-star" data-readonly/>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('home.module.ga')
                <div id="loadmore"></div>
                <input id="currentPage" type="hidden" value="1">
                <div class="clearfix"></div>
                <div class="text-center" style="padding-bottom: 5px;">
                    <button class="btn btn-default" onclick="getPostsRating()" type="button">Show More</button>
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


<script src="{{ asset('resources/assets/site/js/bootstrap-rating.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

    function getPostsRating() {
           var page = parseInt($("#currentPage").val()) + 1;
           var url = window.location.href + '?page=' + page;
           $.ajax({
               url : url,
               dataType: 'json',
           }).done(function (data) {
               $('#loadmore').append(data.html);
               $("#currentPage").val(data.currentPage);
               $('input.rating').rating();

           }).fail(function () {
               alert('Posts could not be loaded.');
           });
       }

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