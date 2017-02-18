@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])

@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-12">
            <ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb-v5">
                <li itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url('/') }}">
                    <span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="active">{{ $page->title }}</li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9">
            @include('errors.alert')
            <!-- Top Apps -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left">{{ $page->title }}</h1>
                </div>
                <div class="panel-body">
                    {!! $page->content !!}
                </div>
                @include('home.module.ga')
                <div class="clearfix"></div>
            </div>
            <!-- End Top Apps -->



        </div>
        <div class="col-xs-12 col-sm-3">

            @include('home.module.ga')


        </div>
    </div>



<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

</script>


@endsection