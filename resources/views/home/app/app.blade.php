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
<meta property="og:url"           content="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug) }}" />
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
                <div class="col-xs-12 col-sm-6">
                    
                </div>


                <!--<div class="col-lg-12">-->

                    <div class="detail-tab  left">
                        <div class="left select-tab">
                            <a href="javascript:changeTab('detail')" class="detail active">Details</a>
                            <a href="javascript:changeTab('rate')" class="rate">Infomation</a>
                            <a href="javascript:changeTab('related'); mainSlider.redrawSlider();" class="related">Screenshot</a>
                        </div>
                    </div>
                    <div class="tab-content tab-detail show">
                        
                        <div>
                            You are viewing <a href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug) }}" title="{{$app->name}} app"> <strong>{{$app->name}} app</strong> </a> version {{ ($version)? $version->name: '' }} for free which is produce by {{ $app->developer->name }}. This app is one of  {{ $category->name }} {{ $parentCategory->name }} which require your Mobile or Tablet using Android {{ ($version)? $version->minos: '2.2' }}+. You also can find more information and click to the link below to download page. ApkEarn will be up to date daily, thus this is the latest version of <strong>{{$app->name}}</strong>. <br>

                            <br>Please aware: We’re sharing the original APK file of  <strong>{{$app->name}}</strong> which belong to {{ $app->developer->name }}. This apk does not include any cheat, crack, unlimited gold, ads….or any changes. All the apps &amp; games here are for home or personal use only. If any apk download infringes your copyright, please <a class="nounderline" href="http://apkearn.com/contact-us" target="_blank">contact us</a>. <br>
                            Hope you enjoy experience with <strong>{{$app->name}}</strong>!!!


                        </div>
                        <div class="headline"><h2>Details of {{ $app->name }} apk @if($version) version {{$version->name}} @endif</h2></div>

                        <div class="con_hiden" id="content_detail" style="height: 220px;">

                            <span itemprop="description">{!!  $app->content !!}</span>
                        </div>
                        <div class="show_more_content">
                            <a href="javascript:;" id="show_more" onclick="Store.ShowMoreContent('content_detail');"><i class="fa fa-angle-double-down fa-2x"></i></a>
                        </div>
                        <h5>
                            <a  class="nounderline" href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug.'-download') }}" title="Proceed to {{ $app->name}} Download Page"><i class="fa fa-cloud-download"></i> Proceed to {{ $app->name}} Download Page</a>
                        </h5>
                        <div class="col-xs-12 col-sm-8">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- linkadsauto -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-6611746871494574"
                                 data-ad-slot="1375199040"
                                 data-ad-format="link"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});</script>
                        </div>
                    </div><!--tab-detal------------------------------------>
                    <div class="tab-content tab-rate">
                        
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


                        @if($version)

                        <div class="headline"><h2>All Versions</h2></div>

                        <div class="listVersion">
                            <ul>
                                @foreach($allversion as $version)
                                <?php $link = url('android-apps-games/' . $category->slug . '/' . $app->slug . '/' . $version->slug) ?>
                                <li>
                                    <a href="{{ $link }}">
                                        <h3>{{ $app->name .' '. $version->name }} apk</h3>
                                    </a>
                                    <a href="javascript:;" id="info_{{$version->id}}" onclick="Store.ShowInfoVersion({{ $version->id }})" class="info"><i class="fa fa-exclamation-circle"></i></a>
                                    <a href="{{ $link }}" class="infoDownload"><i class="fa fa-cloud-download"></i></a>
                                </li>
                                <li class="subinfo" id="app_{{ $version->id }}">
                                    <div class="lastUpdate">
                                        <div><span>Version</span>: {{ $version->name }}</div>
                                        <div><span>Filename</span>: {{ $version->appfiles->filename }}</div>
                                        @if($version->appfiles->filesize > 0)
                                        <div><span>File size</span>: {{ human_filesize($version->appfiles->filesize) }}</div>
                                        @endif
                                        <div><span>Updated</span>: {{ $version->version_updated->format('F d, Y') }}</div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        @endif
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





                    </div><!--tab-rate------------------------------------>
                    <div class="tab-content tab-related">
                       
                        <div class="headline"><h2>{{ $app->name }} Apk Screenshots</h2></div>
                        @if(sizeof($app->thumbs) > 0)
                        <ul class="bxslider">
                            @foreach($app->thumbs as $thumb)
                            <li class="slide"><img itemprop="screenshot" src="{{ asset('storage/'.$app->path.'/thumbs/'.$thumb) }}" /></li>
                            @endforeach
                        </ul>
                        @endif



                    </div><!--tab-relate------------------------------------>
                    <link rel="stylesheet" type="text/css" href="http://appstore.unityappstudio.com/css/detail.css">
                    <script type="text/javascript" src="http://appstore.unityappstudio.com/js/detail.js"></script>
                    <div id="footer-text">
                    </div>
                <!--</div>-->






                <!--                <div>
                                    You are viewing <a href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug) }}" title="{{$app->name}} app"> <strong>{{$app->name}} app</strong> </a> version {{ ($version)? $version->name: '' }} for free which is produce by {{ $app->developer->name }}. This app is one of  {{ $category->name }} {{ $parentCategory->name }} which require your Mobile or Tablet using Android {{ ($version)? $version->minos: '2.2' }}+. You also can find more information and click to the link below to download page. ApkEarn will be up to date daily, thus this is the latest version of <strong>{{$app->name}}</strong>. <br>
                
                                    <br>Please aware: We’re sharing the original APK file of  <strong>{{$app->name}}</strong> which belong to {{ $app->developer->name }}. This apk does not include any cheat, crack, unlimited gold, ads….or any changes. All the apps &amp; games here are for home or personal use only. If any apk download infringes your copyright, please <a class="nounderline" href="http://apkearn.com/contact-us" target="_blank">contact us</a>. <br>
                                    Hope you enjoy experience with <strong>{{$app->name}}</strong>!!!
                
                
                                </div>-->

                <!--                <div class="headline"><h2>Details of {{ $app->name }} apk @if($version) version {{$version->name}} @endif</h2></div>
                
                                <div class="con_hiden" id="content_detail" style="height: 220px;">
                
                                    <span itemprop="description">{!!  $app->content !!}</span>
                                </div>
                                <div class="show_more_content">
                                    <a href="javascript:;" id="show_more" onclick="Store.ShowMoreContent('content_detail');"><i class="fa fa-angle-double-down fa-2x"></i></a>
                                </div>-->
            </div>
            <!--<div class="row panel-body">-->
                <!--                <div class="col-xs-12 col-sm-8">
                                    <h5>
                                        <a  class="nounderline" href="{{ url('android-apps-games/'.$category->slug.'/'.$app->slug.'-download') }}" title="Proceed to {{ $app->name}} Download Page"><i class="fa fa-cloud-download"></i> Proceed to {{ $app->name}} Download Page</a>
                                    </h5>
                                    <div class="col-xs-12 col-sm-8">
                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                         linkadsauto 
                                        <ins class="adsbygoogle"
                                             style="display:block"
                                             data-ad-client="ca-pub-6611746871494574"
                                             data-ad-slot="1375199040"
                                             data-ad-format="link"></ins>
                                        <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});</script>
                                    </div>
                
                                </div>-->




                <!--                <div class="headline"><h2>{{ $app->name }} Apk Additional Information</h2></div>
                
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
                                </ul>-->

                <!--                <div class="headline"><h2>{{ $app->name }} Apk Screenshots</h2></div>
                
                                <div class="col-xs-12 col-sm-12">
                                    @if(sizeof($app->thumbs) > 0)
                                    <ul class="bxslider">
                                        @foreach($app->thumbs as $thumb)
                                        <li class="slide"><img itemprop="screenshot" src="{{ asset('storage/'.$app->path.'/thumbs/'.$thumb) }}" /></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>-->
            <!--</div>-->


            <!--<hr>-->


            <!--<div class="row panel-body">-->
                <!--                <div class="col-xs-12 col-sm-8">
                
                
                
                
                                    @if($version)
                
                                    <div class="headline"><h2>All Versions</h2></div>
                
                                    <div class="listVersion">
                                        <ul>
                                            @foreach($allversion as $version)
                <?php // $link = url('android-apps-games/' . $category->slug . '/' . $app->slug . '/' . $version->slug) ?>
                                            <li>
                                                <a href="{{ $link }}">
                                                    <h3>{{ $app->name .' '. $version->name }} apk</h3>
                                                </a>
                                                <a href="javascript:;" id="info_{{$version->id}}" onclick="Store.ShowInfoVersion({{ $version->id }})" class="info"><i class="fa fa-exclamation-circle"></i></a>
                                                <a href="{{ $link }}" class="infoDownload"><i class="fa fa-cloud-download"></i></a>
                                            </li>
                                            <li class="subinfo" id="app_{{ $version->id }}">
                                                <div class="lastUpdate">
                                                    <div><span>Version</span>: {{ $version->name }}</div>
                                                    <div><span>Filename</span>: {{ $version->appfiles->filename }}</div>
                                                    @if($version->appfiles->filesize > 0)
                                                    <div><span>File size</span>: {{ human_filesize($version->appfiles->filesize) }}</div>
                                                    @endif
                                                    <div><span>Updated</span>: {{ $version->version_updated->format('F d, Y') }}</div>
                                                </div>
                                            </li>
                                            @endforeach
                
                                        </ul>
                                    </div>
                                    @endif
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
                
                                </div>-->
                <div class="col-xs-12 col-sm-4">
                    @include('home.module.ga')
                </div>
            <!--</div>-->
            <div class="clearfix"></div>
            <div class="row detailApp">
                <ul class="list-unstyled">
                    <li class="dotshare">
                        <span class="fb-share"><div class="g-plusone" data-size="medium"></div></span>
                        <span class="fb-share">
                            <div class="fb-like" data-href="{{ url($parentCategory->slug.'/'.$app->slug) }}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End App Detail -->

        <!-- Comment -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h5 class="pull-left">Comment</h5>
            </div>
            <div class="panel-body">
                <div id="disqus_thread"></div>
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                                        var disqus_shortname = 'apkearn';
                                        (function() {
                                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                        })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            </div>
        </div>
        <!-- end Comment -->

        <!-- Similar -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h4 class="pull-left">Top Apps</h4>
            </div>
            @foreach($topapps as $app)
            <?php
            $link = url('android-apps-games/' . $category->slug . '/' . $app->slug);
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
        @include('home.module.similar')
        @include('home.module.topgames')


    </div>
</div>

<script type="text/javascript" src="{{ asset('resources/assets/home/js/jquery.bxslider.min.js') }}" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="{{ asset('resources/assets/home/css/jquery.bxslider.css') }}" media="screen" />
@if(sizeof($app->thumbs) > 0)
<script type="text/javascript">
<?php
$size = @getimagesize(asset('storage/' . $app->path . '/thumbs/' . $app->thumbs[0]));
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
                                        var mainSlider = $('.bxslider').bxSlider({

                                        slideWidth: 200,
                                                minSlides: 1,
                                                maxSlides: 5,
                                                slideMargin: 10
                                        });</script>
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
                                                if (data.error == 0){
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