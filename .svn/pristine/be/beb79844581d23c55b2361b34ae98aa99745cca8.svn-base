@extends('home.master')

@if($version)
    @section('title', 'Download '.$app->name.' '.$version->name.' Apk Free for Android - Apps.com.mm')
@else
    @section('title', 'Download '.$app->name.' Apk Free for Android - Apps.com.mm')
@endif

@section('description', 'Download '.$app->category->name .' '.$parentCategory->name.' '.$app->name.' Apk for Android and many apps and games free at apkearn.com')

@section('keywords', 'download apk, download apk for android, android, '.$app->developer->name.', '.$app->keyword)

@section('facebook')
    <meta property="og:url"           content="{{ url($parentCategory->slug.'/'.$app->slug.'-apk-download') }}" />
    <meta property="og:type"          content="product" />
    <meta property="og:title"         content="{{ $app->name.' apk download page - Apps.com.mm' }}" />
    <meta property="og:description"   content="{{ 'Free Download '.$app->category->name .' '.$parentCategory->name.' '.$app->name.' Apk for Android' }}" />
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
                <li class="active">Download {{ $app->name}} {{($version)? $version->name: ''}}</li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9">
            <!-- Download Detail -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left">Download {{ $app->name }} {{($version)? $version->name: ''}} apk for android</h1>

                </div>

                <div class="row panel-body">

                    <div itemscope itemtype="http://schema.org/SoftwareApplication">
                        <meta itemprop="name" content="{{ $app->name }}" />
                        <meta itemprop="keywords" content="{{ $app->keyword }}" />
                        <meta itemprop="fileFormat" content="application/vnd.android.package-archive" />
                        <meta itemprop="operatingSystem" content="Android" />
                        <meta itemprop="applicationCategory" content="{{$app->category->name}}" />

                      <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                          <meta itemprop="ratingValue" content="{{ $app->rate_value }}" />
                          <meta itemprop="ratingCount" content="{{ $app->rate_count }}" />
                      </div>

                      <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="price" content="0.00" />
                        <meta itemprop="priceCurrency" content="USD" />
                      </div>
                    </div>


                    <div class="col-xs-12 col-sm-8">

                        <p>
	                            Please aware: We’re sharing the original APK file of  <strong>{{$app->name}}</strong> which belong to {{ $app->developer->name }}. This apk does not include any cheat, crack, unlimited gold, ads….or any changes. All the apps &amp; games here are for home or personal use only. If any apk download infringes your copyright, please <a class="nounderline" href="http://apkearn.com/contact-us" target="_blank">contact us</a>. <br>
							Hope you enjoy experience with <strong>{{$app->name}}</strong>!!!
	                        <br>
							<p>Apps.com.mm provide the mirror server to <strong>download {{$app->name}} apk</strong>:</p>
	                        
	                            @if($version)
                                
                                    <a class="nounderline" href="javascript:;" <?php if (!isset($user) || empty($user)) { ?> data-toggle="modal" data-target="#signin" <?php } else { ?> onclick="getapk()" <?php } ?> >Download from Apps.com.mm and Install It
	                                    @if($version->appfiles->filesize)
	                                        ({{ human_filesize($version->appfiles->filesize) }})
	                                    @endif
	                                </a><br>
	                            @endif
<div class="col-xs-12 col-sm-12">
<!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 linkadsauto 
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6611746871494574"
     data-ad-slot="1375199040"
     data-ad-format="link"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>-->
</div>


	                        </p>

                        @if($searchterms->first())
                        <h4>Incomming search terms:</h4>
                        <p>
                            <ul class="list-unstyled">
                            @foreach($searchterms as $term)
                                <li>{{ $term->keyword }}</li>
                            @endforeach
                            </ul>
                        </p>
                        @endif
                        <h4>File Informations</h4>

                        <ul class="list-unstyled">
                            @if($version)
                                <li class="version">Version: <span itemprop="softwareVersion">{{ $version->name }}</span></li>
                                <li>Filename: {{$version->appfiles->filename}}</li>
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
                        
                        @if($version)
                            <form id="download_form" method="post" action="{{url('download-apk/'.$version->slug)}}">
                                <?php if(isset($user) && !empty($user)) { ?>
                                <input type="hidden" name="version_id" value="{{ $version->id }}" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <?php } ?>
                            </form>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        @include('home.module.ga')
                    </div>
                </div>

                <hr>


                <div class="clearfix"></div>
            </div>
            <!-- End Download Detail -->

            <!-- Similar -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h4 class="pull-left">Similar or Related</h4>
                </div>
                @foreach($similars as $app)
                    <?php
                        $link = url($parentCategory->slug.'/'.$app->slug);
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
                                <p class="subCard te"><a href="{{ $app->developer->slug }}">{{ $app->developer->name }}</a></p>
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



    <script type="text/javascript" src="{{ asset('resources/assets/home/js/bootbox.min.js') }}" charset="UTF-8"></script>
    <script>

        function getapk()
        {
            $('#download_form').submit();
        }



    </script>

    @if($version)
        <script>
            function report()
                {
                    bootbox.confirm({
                        message: "Are you sure this download link is broken?",
                        callback: function(result) {
                            if(result){
                                var version_id = "{{ $version->id }}";
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('api/report') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        version_id: version_id
                                    },
                                    success: function(){
                                        bootbox.alert({
                                            message: "We'll fix download link asap",
                                            title: "Thank You",

                                            className: "bootbox-sm"
                                        });
                                    }
                                });
                            }
                        },
                        className: "bootbox-sm"
                    });
                }
        </script>
    @endif

@endsection