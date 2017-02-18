<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <title>@yield('title')</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="google-site-verification" content="{{$setting->configs['webmaster'] or ''}}" />
        <meta name="alexaVerifyID" content="{{$setting->configs['alexa'] or ''}}" />
        <meta name="msvalidate.01" content="{{$setting->configs['bing'] or ''}}" />
        <meta name='yandex-verification' content='60c016e3f4b683c9' />
        <meta name="p:domain_verify" content="3c078a5a678b7b75bb1a1e889e7869e8"/>
        @section('facebook')
        <meta property="og:url"           content="{{ url('/') }}" />
        <meta property="og:type"          content="product" />
        <meta property="og:title"         content="{{ $setting->configs['site_name'] }}" />
        <meta property="og:description"   content="{{ $setting->configs['des'] }}" />
        <meta property="og:image"         content="{{ asset('storage/assets/site/img/lovov.jpg') }}" />
        @show

        @if($setting->configs['analytics'] != '')
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', '{{$setting->configs['analytics']}}', 'auto');
            ga('send', 'pageview');
        </script>
        @endif
        <script type="application/ld+json">
            { "@context" : "http://schema.org",
            "@type" : "Organization",
            "name" : "{{ $setting->configs['site_name'] }}",
            "url" : "{{ url('/') }}",
            "sameAs" : [
            "{{ $setting->configs['facebook'] }}",
            "{{ $setting->configs['twitter'] }}",
            "{{ $setting->configs['google'] }}"
            ]
            }

        </script>

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/plugins/bootstrap/css/bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('resources/assets/home/plugins/font-awesome/css/font-awesome.min.css') }}">

        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/skin-green.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/apk.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/apkplz.style.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/blocks.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/home/css/custom_thanglv.css') }}">


        <script src="{{ asset('resources/assets/home/js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('resources/assets/home/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('resources/assets/home/js/apkplz.app.js') }}"></script>
        <script src="{{ asset('resources/assets/home/js/store.js') }}"></script>
        <script src="{{ asset('resources/assets/home/js/plugins.js') }}"></script>
        <script src="{{ asset('resources/assets/home/js/common.js') }}"></script>

    </head>


    <body class="off">
        <!-- /.wrapbox start-->
        <div class="wrapbox">
            <!-- TOP AREA
    ================================================== -->

<!--            <section class="toparea">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 top-text pull-left">
                            <div itemscope itemtype="http://schema.org/WebSite">
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
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="social-icons">
                                <a  class="icon icon-facebook nounderline" href="{{ url($setting->configs['facebook']) }}"></a>
                                <a class="icon icon-twitter nounderline" href="{{ url($setting->configs['twitter']) }}"></a>
                                <a class="icon icon-google-plus nounderline" href="{{ url($setting->configs['google']) }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            <!-- /.toparea end-->
            <!-- NAV
    ================================================== -->
            <nav class="navbar navbar-fixed-top wowmenu" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand logo-nav" href="{{ url('/') }}"><img src="{{ asset('resources/assets/home/img/wlogo.png') }}"></a>
                    </div>
                    <div class="col-md-5 col-sm-4 top-text pull-left" id="search_large">
                        <div itemscope itemtype="http://schema.org/WebSite">
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
                    </div>
                    <ul id="nav" class="nav navbar-nav pull-right">
                        <li class="{{ ($home == 'home')?'active': '' }}">
                            <a href="{{ url('/') }}">HOME</a>
                        </li>
                        <li class="{{ ($home == 'apps')?'active': '' }}">
                            <a href="{{ url('apps') }}">APPS</a>
                        </li>
                        <li class="{{ ($home == 'games')?'active': '' }}">
                            <a href="{{ url('games') }}">GAMES</a>
                        </li>
                        <li class="{{ ($home == 'contact')?'active': '' }}">
                            <a href="{{ url('contact-us') }}">CONTACT</a>
                        </li>
                        <?php if (!isset($user) || empty($user)) { ?> 
                            <li class="{{ ($home == 'login')?'active': '' }}" <?php if ($home != 'login') { ?> data-toggle="modal" data-target="#signin" <?php } ?>>
                                <a href="{{ url('user/login') . '?redirectTo=' . "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" }}" onclick="return false;">LOGIN</a>
                            </li>
                        <?php } else { ?>
                            <li class="{{ ($home == 'profile')?'active': '' }}">
                                <a href="javascript:void(0)" id="profile">PROFILE</a>
                                <ul class="dropdown-menu">
                                    <li><span><?=$user->name?></span></li>
                                    <li><a href="/user/profile">My Profile</a></li>
                                    <li><a href="/user/referral">Referral</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/user/logout">Logout</a></li>

                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>
            <!-- /nav end-->

            <!-- Main ======================================== !-->
            <div class="clearfix"></div>
            <div class="container content">
                @yield('content')
            </div>
            <!-- End Main ======================================== !-->



            <section>
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="pull-left">
                                    Copyright&copy; 2015 by Apps.com.mm
                                </p>
                            </div>
                            <div class="col-md-8">


                                <ul class="footermenu pull-right">
                                    <li><a href="{{ url('page/about-us') }}">About Us</a></li>
                                    <li><a href="{{ url('page/terms-of-use') }}">Terms Of Use</a></li>
                                    <li><a href="{{ url('page/privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('page/dmca-policy') }}">DMCA Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>



        <!-- Modal -->
        <div class="modal fade" id="signin" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Welcome to</h4>
                        <div class="modal_logo"><img src="{{ asset('resources/assets/home/img/wlogo.png') }}" /></div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                                <form method="post" action="/user/login">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" name="remember" value="1"><b>Remember me</b></label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success">Login</button>
                                    </div>
                                    <input type="hidden" name="redirectTo" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <p class="fs-12">Forgot password? <a href="" data-toggle="modal" data-target="#forgotPassword" data-dismiss="modal">Click here</a></p>
                                    </div>
                                    <div class="form-group">
                                        <p class="fs-12">Need an account? <a href="" data-toggle="modal" data-target="#register" data-dismiss="modal">Sign Up here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="register" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Register</h4>
                        <div class="modal_logo"><img src="{{asset('resources/assets/home/img/wlogo.png')}}" /></div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <form class="form-horizontal" method="post" action="/user/register">
                                    <div class="form-group">
                                        <label for="inputName" class="control-label col-xs-3">Name</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label col-xs-3">Email</label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-3">Password</label>
                                        <div class="col-xs-9">
                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputConfirmPassword" class="control-label col-xs-3" name="confirmPassword">Re-Password</label>
                                        <div class="col-xs-9">
                                            <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBirthday" class="control-label col-xs-3">Birthdate</label>
                                        <div class="col-xs-3">
                                            <select name="birthday-day" class="form-control">
                                                <?php for ($i = 1;
                                                        $i <= 31; $i++) { ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                        <div name="birthday-month" class="col-xs-3">
                                            <select class="form-control">
                                                <?php for ($i = 1;
                                                        $i <= 12; $i++) { ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                        <div name="birthday-year" class="col-xs-3">
                                            <select class="form-control">
                                                <?php for ($i = 1930;
                                                        $i <= 2016; $i++) { ?>
                                                    <option value="<?= $i ?>" <?php if ($i == 1990) echo 'selected'; ?>><?= $i ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSex" class="control-label col-xs-3">Sex</label>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" checked value="none"> None
                                            </label>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="male"> Male
                                            </label>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="female"> Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-3">Location</label>
                                        <div class="col-xs-9">
                                            <select class="form-control">
                                                <option value="Yangon">Yangon</option>
                                                <option value="Mandalay">Mandalay</option>
                                                <option value="Naypyitaw">Naypyitaw</option>
                                                <option value="Ayeyarwaddy">Ayeyarwaddy</option>
                                                <option value="Bago">Bago</option>
                                                <option value="Chin">Chin</option>
                                                <option value="Kayah">Kayah</option>
                                                <option value="Kayin">Kayin</option>
                                                <option value="Kachin">Kachin</option>
                                                <option value="Magway">Magway</option>
                                                <option value="Mon">Mon</option>
                                                <option value="Rakhine">Rakhine</option>
                                                <option value="Sagaing">Sagaing</option>
                                                <option value="Shan">Shan</option>
                                                <option value="Tanintharyi">Tanintharyi</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-xs-offset-3 col-xs-9">
                                            <button type="submit" class="btn btn-success btn-block">Register</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-offset-3 col-xs-9">
                                            <p class="fs-12">Already a member? <a href="" data-toggle="modal" data-target="#signin" data-dismiss="modal" >Login</a></p>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="forgotPassword" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Welcome to</h4>
                        <div class="modal_logo"><img src="{{asset('resources/assets/home/img/wlogo.png')}}" /></div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                                <form method="post" action="/user/reset">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success">Reset My Password</button>
                                    </div>
                                    <?php echo csrf_field() ?>
                                    <div class="form-group">
                                        <p class="fs-12">Have another account? <a href="" data-toggle="modal" data-target="#signin" data-dismiss="modal">Login</a></p>
                                    </div>
                                    <div class="form-group">
                                        <p class="fs-12">Need an account? <a href="" data-toggle="modal" data-target="#register" data-dismiss="modal">Sign Up here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>


</html>