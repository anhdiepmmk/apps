<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dashboard - Administrator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="{{asset('resources/assets/pixel/stylesheets/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('resources/assets/pixel/stylesheets/pixel-admin.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('resources/assets/pixel/stylesheets/widgets.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('resources/assets/pixel/stylesheets/rtl.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('resources/assets/pixel/stylesheets/themes.min.css')}}" rel="stylesheet" type="text/css">

	<link href="{{asset('resources/assets/pixel/stylesheets/nadmin.css')}}" rel="stylesheet" type="text/css">

	<script src="{{asset('resources/assets/pixel/javascripts/jquery.2.0.3.min.js')}}"></script>


	<!--[if lt IE 9]>
		<script src="{{asset('resources/assets/pixel/javascripts/ie.min.js')}}"></script>
	<![endif]-->
	@section('css')
    @show
</head>

<body class="theme-default main-menu-animated">
<script>var init = [];</script>
<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ===========================================================================

	Main navigation
-->
	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">

				<!-- Logo -->
				<a href="{{ url('/admin') }}" class="navbar-brand">
					<div><img alt="NEK Admin" src="{{asset('resources/assets/pixel/images/pixel-admin/main-navbar-logo.png')}}"></div>
					Home
				</a>

				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ url('admin') }}">Dashboard</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Cronjob</a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('admin/cronjob') }}">Get New Apps</a></li>
								<li><a href="{{ url('admin/cronone') }}">Get 1 New App</a></li>
								<li><a href="{{ url('admin/checkversion') }}">Version Checking</a></li>
								<li><a href="{{ url('admin/download') }}">Crawl APK File</a></li>
								<li><a href="{{ url('admin/similar') }}">Get Similar Apps</a></li>
								<li class="divider"></li>
<!--								<li><a href="{{ url('admin/facebook') }}">Cron Facebook</a></li>-->
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuration</a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('admin/settings/config') }}">Website Information</a></li>
							</ul>
						</li>
						<li>
							<a href="{{ url('admin/nodllink') }}">
								Apps without download URL
							</a>
						</li>
					</ul>

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">



							<li>
								<form class="navbar-form pull-left">
									<input type="text" class="form-control" placeholder="Search">
								</form>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<i class="dropdown-icon fa fa-user"></i>
									<span>{{ Auth::user()->name }}</span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ url('admin/user/account') }}"><i class="dropdown-icon fa fa-key"></i>&nbsp;&nbsp;Profile</a></li>
									<li class="divider"></li>
									<li><a href="{{ url('/auth/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
								</ul>
							</li>
							<li>
							    <a href="{{ url('/') }}"><i class="dropdown-icon fa fa-desktop"></i> Website</a>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->


<!-- 4. $MAIN_MENU =================================================================================

-->
	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">


			<ul class="navigation">
				<li>
					<a href="{{ url('/admin') }}"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
				</li>


				<li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-android"></i><span class="mm-text">Apps</span></a>
                    <ul>
                        <li>
                            <a tabindex="-1" href="{{ url('admin/category') }}"><span class="mm-text">Categories</span></a>
                        </li>
                        <li>
                            <a tabindex="-1" href="{{ url('admin/app') }}"><span class="mm-text">Apps Management</span></a>
                        </li>
                    </ul>
                </li>
				<li>
					<a href="{{ url('/admin/report') }}"><i class="menu-icon fa fa-exclamation-triangle"></i><span class="mm-text">Report</span></a>
				</li>
				<li>
					<a href="{{ url('admin/pages') }}"><i class="menu-icon fa fa-newspaper-o"></i><span class="mm-text">Pages</span></a>
				</li>
				<li>
					<a href="{{ url('admin/contact') }}"><i class="menu-icon fa fa-comment"></i><span class="mm-text">Contact</span></a>
				</li>
				<li>
					<a href="{{ url('admin/settings/config') }}"><i class="menu-icon fa fa-cogs"></i><span class="mm-text">Configuration</span></a>
				</li>
                <li>
					<a href="{{ url('admin/user') }}"><i class="menu-icon fa fa-user"></i><span class="mm-text">Users</span></a>
				</li>
<!--                <li>
					<a href="{{ url('admin/admin') }}"><i class="menu-icon fa fa-legal"></i><span class="mm-text">Admins</span></a>
				</li>-->

			</ul> <!-- / .navigation -->

		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->

	<div id="content-wrapper">

        @yield('content')

	</div> <!-- / #content-wrapper -->
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="{{asset('resources/assets/pixel/javascripts/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/pixel/javascripts/pixel-admin.js')}}"></script>
<script src="{{asset('resources/assets/pixel/javascripts/nadmin.js')}}"></script>

<script type="text/javascript">

	init.push(function () {

	})
	window.PixelAdmin.start(init);

</script>

</body>
</html>