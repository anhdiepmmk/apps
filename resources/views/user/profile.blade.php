@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])



@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-9">

        <div itemscope itemtype="http://schema.org/WebSite" class="visible-xs" style="padding-bottom: 15px">
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

        <!-- My Profile -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">My Profile</h1>
                <ul class="pull-right breadcrumb-right">
                </ul>
            </div>
            @include('errors.alert')
            <div class="col-xs-10 col-lg-offset-1">
                <form class="form-horizontal my_profile" method="post" action="/user/profile">
                    <div class="form-group">
                        <label for="inputName" class="control-label col-xs-3">Name</label>
                        <div class="col-xs-9">
                            <input type="text" name="name" value="<?= $user->name ?>"  class="form-control" id="inputName" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-xs-3">Email</label>
                        <div class="col-xs-9">
                            <input type="email" value="<?= $user->email ?>" disabled="disabled" class="form-control" id="inputPassword" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBirthDate" class="control-label col-xs-3">Birthdate</label>
                        <div class="col-xs-3">
                            <select name="birthday-day" class="form-control">
                                <?php for ($i = 1;
                                        $i <= 31; $i++) {
                                    ?>
                                    <option value="<?= $i ?>" <?php if ($user->birthday->day == $i) echo 'selected'; ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select name="birthday-month" class="form-control">
                                <?php for ($i = 1;
                                        $i <= 12; $i++) {
                                    ?>
                                    <option value="<?= $i ?>" <?php if ($user->birthday->month == $i) echo 'selected'; ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select name="birthday-year" class="form-control">
                                <?php for ($i = 1930;
                                        $i <= 2016; $i++) {
                                    ?>
                                    <option value="<?= $i ?>" <?php if ($user->birthday->year == $i) echo 'selected'; ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSex" class="control-label col-xs-3">Sex</label>
                        <div class="col-xs-2">
                            <label class="radio-inline">
                                <input type="radio" name="sex" <?php if ($user->sex == 'none') echo 'checked' ?> value="none"> None
                            </label>
                        </div>
                        <div class="col-xs-2">
                            <label class="radio-inline">
                                <input type="radio" name="sex" <?php if ($user->sex == 'male') echo 'checked' ?> value="male"> Male
                            </label>
                        </div>
                        <div class="col-xs-2">
                            <label class="radio-inline">
                                <input type="radio" name="sex" <?php if ($user->sex == 'female') echo 'checked' ?> value="female"> Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-3">Location</label>
                        <div class="col-xs-9">
                            <select class="form-control" name="location">
                                <option <?php if ($user->location == 'Yangon') echo 'selected' ?> value="Yangon">Yangon</option>
                                <option <?php if ($user->location == 'Mandalay') echo 'selected' ?> value="Mandalay">Mandalay</option>
                                <option <?php if ($user->location == 'Naypyitaw') echo 'selected' ?> value="Naypyitaw">Naypyitaw</option>
                                <option <?php if ($user->location == 'Ayeyarwaddy') echo 'selected' ?> value="Ayeyarwaddy">Ayeyarwaddy</option>
                                <option <?php if ($user->location == 'Bago') echo 'selected' ?> value="Bago">Bago</option>
                                <option <?php if ($user->location == 'Chin') echo 'selected' ?> value="Chin">Chin</option>
                                <option <?php if ($user->location == 'Kayah') echo 'selected' ?> value="Kayah">Kayah</option>
                                <option <?php if ($user->location == 'Kayin') echo 'selected' ?> value="Kayin">Kayin</option>
                                <option <?php if ($user->location == 'Kachin') echo 'selected' ?> value="Kachin">Kachin</option>
                                <option <?php if ($user->location == 'Magway') echo 'selected' ?> value="Magway">Magway</option>
                                <option <?php if ($user->location == 'Mon') echo 'selected' ?> value="Mon">Mon</option>
                                <option <?php if ($user->location == 'Rakhine') echo 'selected' ?> value="Rakhine">Rakhine</option>
                                <option <?php if ($user->location == 'Sagaing') echo 'selected' ?> value="Sagaing">Sagaing</option>
                                <option <?php if ($user->location == 'Shan') echo 'selected' ?> value="Shan">Shan</option>
                                <option <?php if ($user->location == 'Tanintharyi') echo 'selected' ?> value="Tanintharyi">Tanintharyi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3"></div>
                    {{csrf_field()}}

                    <div class="col-xs-9">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fa fa-floppy-o"></i> 
                                    Edit
                                </button>
                            </div>
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-danger btn-block">
                                    <i class="fa fa-close"></i> 
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="clearfix"></div>
            <br>
        </div>
        <!-- End My Profile -->

        <!-- Change Password -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Change Password</h1>
                <ul class="pull-right breadcrumb-right">
                </ul>
            </div>

            <div class="col-xs-10 col-lg-offset-1">
                <form class="form-horizontal change_password" method="post" action="/user/password">

                    <div class="form-group">
                        <label for="inputOldPassword" class="control-label col-xs-3">Old Password</label>
                        <div class="col-xs-9">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNewPassword" class="control-label col-xs-3">New Password</label>
                        <div class="col-xs-9">
                            <input type="password" class="form-control" id="inputPassword" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputReNewPassword" class="control-label col-xs-3">Re New Password</label>
                        <div class="col-xs-9">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Re New Password">
                        </div>
                    </div>

                    {{csrf_field()}}


                    <div class="col-xs-3"></div>

                    <div class="col-xs-9">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fa fa-floppy-o"></i> 
                                    Change
                                </button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>

            <div class="clearfix"></div>
            <br>
        </div>
        <!-- End My Profile -->


    </div>
    <div class="col-xs-12 col-sm-3">
        <!-- Top Referrals -->
        <div class="nborder">
            <div class="breadcrumbs">
                <h1 class="pull-left">Setting</h1>
            </div>

            <div class="col-sm-12">
                <div class="menu_profile">
                    <ul>
                        <li><a href="{{asset('user/profile')}}" class="active">Profile</a></li>
                        <li><a href="{{asset('user/referral')}}">Referral</a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End New Apps -->







    </div>
</div>







<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=853746324651467";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@endsection