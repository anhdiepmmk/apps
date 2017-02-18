@extends('home.master')

@if($version)

    @section('title', 'Download '.$app->name.' '.$version->name.' Apk Free for Android')
    @section('description', 'Download '.$app->name.' Apk Free for Android')
@else

    @section('title', 'Download '.$app->name.' Apk Free for Android')
    @section('description', 'Download '.$app->name.' Apk Free for Android')
@endif


@section('keywords', 'download apk, download apk for android, android, '.$app->developer->name.', '.$app->keyword)

@section('facebook')
    <meta property="og:url"           content="{{ url($category->slug.'/'.$app->slug) }}" />
    <meta property="og:type"          content="product" />
    <meta property="og:title"         content="{{ $app->name.' apk download for android' }}" />
    <meta property="og:description"   content="{{ 'Download '.$app->name.' Apk for Android' }}" />
    <meta property="og:image"         content="{{ asset('storage/'.$app->path.'/300/'.$app->image) }}" />
    <meta property="fb:app_id"        content="1200970193263843" />
@endsection


@section('content')
    <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1200970193263843";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>



    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb-v5">
                <li itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url('/') }}">
                    <span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1" />
                </li>
                <li itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url($parentCategory->slug) }}">
                    <span itemprop="name">{{ $parentCategory->name }}</span></a>
                    <meta itemprop="position" content="2" />
                </li>
                <li itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url($parentCategory->slug.'/'.$app->category->slug) }}">
                    <span itemprop="name">{{ $app->category->name }}</span></a>
                    <meta itemprop="position" content="3" />
                </li>
                <li class="active">{{ $app->name }}</li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9">
            <!-- App Detail -->
            <div class="nborder">

                <div class="row detailApp">

                    <div class="col-xs-4 col-sm-2">
                        <div class="thumbnail">
                            <img class="img-responsive" src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}" />
                        </div>
                    </div>

                    <div class="col-xs-8 col-sm-8">
                        <h1>{{ $app->name }} APK @if($version) {{$version->name}} @endif</h1>
                        <ul class="list-unstyled">
                            <li>
                                Free <a class="nounderline" href="{{ url($parentCategory->slug.'/'.$app->category->slug) }}"><b>{{ $category->name }}</b></a> by
                                <a class="nounderline" href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a>
                            </li>
                            <li>
                                Rating:
                                <input type="hidden" class="ratingapp" value="{{ $app->rate_value }}" data-filled="rating-selected fa fa-star" data-empty="rating fa fa-star" />
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix" style="height: 10px"></div>
                    <div>
                        You are downloading free <strong>{{$app->name}} app</strong> version {{ ($version)? $version->name: '' }} which is shareing by apps.com.mm Please select one of below server for downloading the Apk. It is so easy for installing your favour app.<br><br>
						This app is one of  {{ $category->name }} {{ $parentCategory->name }} which require your Mobile or Tablet using Android {{ ($version)? $version->minos: '2.2' }}+. You also can find more information and click to the link below to <a href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug).'-apk' }}" title="download {{$app->name}} apk"> <strong>download {{$app->name}} apk</strong> </a>. UAS will be up to date daily, thus this is the latest version. <br>
						Please aware: We’re sharing the original APK file of  <strong>{{$app->name}}</strong> which belong to {{ $app->developer->name }}. This apk does not include any cheat, crack, unlimited gold, ads….or any changes. All the apps &amp; games here are for home or personal use only. If any apk download infringes your copyright, please <a class="nounderline" href="http://apps.com.mm/contact-us" target="_blank">contact us</a>. <br>
						Hope you enjoy experience with <strong>{{$app->name}}</strong>!!!
                    </div>

                    <div class="headline"><h2>Details of {{ $app->name }} apk @if($version) version {{$version->name}} @endif</h2></div>
                    <div class="con_hiden" id="content_detail" style="height: 220px;">
                        <span itemprop="description">{!!  $app->content !!}</span>
                    </div>
                    <div class="show_more_content">
                        <a href="javascript:;" id="show_more" onclick="Store.ShowMoreContent('content_detail');"><i class="fa fa-angle-double-down fa-2x"></i></a>
                    </div>
                </div>
				
                <div class="row panel-body">
                    @if($searchterms->first())
                    <div class="headline"><h2>Incomming search terms:</h2></div>
                    <p>
                        <ul class="list-unstyled">
                        @foreach($searchterms as $term)
                            <li>{{ $term->keyword }}</li>
                        @endforeach
                        </ul>
                    </p>
                    @endif
                    <div class="headline"><h2>{{ $app->name }} Apk Additional Information</h2></div>

                    <ul class="list-unstyled">
                        @if($version)
                            <li class="version">Version: <span itemprop="softwareVersion">{{ $version->name }}</span></li>
                            @if($version->appfiles->filesize > 0)
                                <li>File size: <span itemprop="fileSize">{{ human_filesize($version->appfiles->filesize) }}</span></li>
                            @endif
                            <li>Requires: Android {{ $version->minos }}+</li>
                        @endif
                        <li class="manufacture" itemprop="author" itemscope itemtype="http://schema.org/Organization">
                            Developer: <a itemprop="url" href="{{ url('manufacture/'.$app->developer->slug) }}"><span itemprop="name">{{ $app->developer->name }}</span></a>
                        </li>
                        <li>Category: <a href="{{ url($parentCategory->slug.'/'.$app->category->slug) }}"><b itemprop="applicationCategory">{{ $app->category->name }}</b></a></li>
                        @if($version)
                            <li>Updated: <span itemprop="datePublished">{{ $version->version_updated->format('F d, Y') }}</span></li>
                        @endif
                    </ul>

                    
                </div>


                <hr>


                <div class="row panel-body">
                    <div class="col-xs-12 col-sm-8">
                        <div class="headline"><h2>Download {{ $app->name }} for Android</h2></div>
                            <div class="col-xs-12 col-sm-3 hidden-xs">
                                <div class="">
                                    <img class="img-responsive" src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-9">
                                <p>Download {{ $app->name }} APK @if($version) version {{$version->name}} @endif</p>
                                <ul class="list-unstyled">
                                    <li>

                                        <a  class="nounderline" target="_blank" href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug.'-download') }}" title="Download {{ $app->name}} @if($version) {{$version->name}} @endif"><i class="fa fa-cloud-download"></i> Direct Download APK from Apps.com.mm</a>
                                    </li>
                                    <li>
                                        <a class="nounderline" target="_blank" href="https://play.google.com/store/apps/details?id={{$app->com}}" title="Download {{ $app->name }} @if($version) {{$version->name}} @endif from Playstore" rel="nofollow"><i class="fa fa-cloud-download"></i> Get it on Google Play</a>
                                    </li>
                                </ul>
                            </div>
                        <div class="clearfix"></div>



                        @if($version)

                        
                        @endif

                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('home.module.ga')
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row detailApp">
                    <ul class="list-unstyled">
                        
                    </ul>
                </div>
            </div>
            <!-- End App Detail -->

            <!-- Comment -->

            <!-- end Comment -->

            <!-- Similar -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h4 class="pull-left">Related</h4>
                </div>
                @foreach($similars as $app)
                    <?php
                        $link = url('android-apps-games/'.$category->slug.'/'.$app->slug);
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
            <!-- End Similar -->


        </div>
        <div class="col-xs-12 col-sm-3">
            @include('home.module.topapps')
            @include('home.module.topgames')


        </div>
    </div>

    <script type="text/javascript" src="{{ asset('resources/assets/home/js/jquery.bxslider.min.js') }}" charset="UTF-8"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('resources/assets/home/css/jquery.bxslider.css') }}" media="screen" />
    @if(sizeof($app->thumbs) > 0)
    <script type="text/javascript">
           <?php
           $size = getimagesize( asset('storage/'.$app->path.'/thumbs/'.$app->thumbs[0]));
           if ($size[0] > 400) {
               $width = '400';
               $max = 2;
           } else {
               $width = '200';
               $max = 5;
           }
           ?>
           var width = {{ $width }};
           var max = {{ $max }};
           $('.bxslider').bxSlider({

               slideWidth: 200,
               minSlides: 1,
               maxSlides: 5,
               slideMargin: 10
           });
    </script>
    @endif

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="{{ asset('resources/assets/home/js/bootstrap-rating.min.js') }}"></script>

<script>
   // rating script
   $('.ratingapp').rating({
     extendSymbol: function () {
       var title;
       $(this).tooltip({
         container: 'body',
         placement: 'bottom',
         trigger: 'manual',
         title: function () {
           return title;
         }
       });
       $(this).on('rating.rateenter', function (e, rate) {
         title = rate;
         $(this).tooltip('show');
       })
       .on('rating.rateleave', function () {
         $(this).tooltip('hide');
       });
     }
   });
   $('.ratingapp').on('change', function () {
        var rate = $(this).val();
       $.ajax({
         type : "POST",
         url : "{{ url('api/rating') }}",
         data: {
             app_id: "{{ $app->id }}",
             rate: rate,
             _token: "{{ csrf_token() }}"

         },
         dataType: "json",
         success:function(data){
            console.log(data);
             if(data.error == 0){
               $('.ratingapp').rating('rate', data.value);
               $("#ratingValue").text(data.value);
               $("#reviewCount").text(data.total_rate);
            }
            //alert(data.msg);
         }
       });
   });


</script>


@endsection