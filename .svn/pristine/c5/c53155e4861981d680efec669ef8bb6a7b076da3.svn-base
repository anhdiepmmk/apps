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
                    <h1 class="pull-left">Result for: {{ $keyword }}</h1>
                </div>
                @foreach($appResult as $app)
                    <?php
                        $parentCategory = \App\Category::find($app->category->parent_id);
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

                <div class="clearfix"></div>
            </div>
            <!-- End Top Apps -->

            <div class="nborder">
                <div class="breadcrumbs">
                    <h4 class="pull-left">Hot</h4>
                </div>
                @foreach($hot_apps as $app)
                    <?php
                        $parentCategory = \App\Category::find($app->category->parent_id);
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
                                <p class="subCard te"><a href="{{ url('developer/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('home.module.ga')

                <div class="clearfix"></div>
            </div>

        </div>
        <div class="col-xs-12 col-sm-3">

            @include('home.module.similar')


        </div>
    </div>



<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

</script>


@endsection