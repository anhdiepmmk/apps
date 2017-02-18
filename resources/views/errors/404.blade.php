@extends('site.master')

@section('title', '404 Page not found - Apk Junction')

@section('description', '404 Page not found - Apk Junction')

@section('keywords',  '404 Page not found - Apk Junction')

@section('content')


    <!-- Breadcrumb -->
    <div>
        <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
          <li itemprop="itemListElement" itemscope
              itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{ url('/') }}">
                <span itemprop="name">Home</span></a>
            <meta itemprop="position" content="1" />
          </li>
          <li itemprop="itemListElement" itemscope
              itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="">
              <span itemprop="name">Page not found</span></a>
            <meta itemprop="position" content="2" />
          </li>
        </ol>
    </div>
    <!-- End Breadcrumb -->

    <div class="col-xs-12 col-sm-9 pl0 featured">
       <div class="nborder">
        <h1 class="pull-left titlecat">Page not found</h1>
        <div class="clearfix"></div>
        <div>
            Page not found!
        </div>
        <div class="col-xs-12 col-sm-12 pr0 pl0">
            <!-- APK LINK -->
            @include('site.module.ga')
        </div>
        <div class="clearfix"></div>
       </div>
    </div>
    <div class="col-xs-12 col-sm-3 pr0 hidden-xs">
        <div class="nborder">
            <div class="clearfix"></div>
            @include('site.module.ga')
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>

    <script type="text/javascript">
        //Store.LoadMore();
        //Store.Banner();
    </script>

@endsection