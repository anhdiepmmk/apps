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
                <h1 class="pull-left">My Referral</h1>
                <ul class="pull-right breadcrumb-right">
                </ul>
            </div>

            <div class="col-xs-12 my-referral">
                <h2>My URL: <a href="http://apps.com.mm/r/{{$user->referral_key}}">http://apps.com.mm/r/{{$user->referral_key}}  </a></h2>
                <div class="clearfix"></div>

                <!--                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="select-month">Select month:</label>
                                                <select class="form-control" id="select-month">
                                                    <option value="0">Select Month</option>
                <?php for ($i = 1; $i <= 12;
                        $i++) { ?>
                                                        <option value="<?= $i ?>" <?php if (isset($params['month']) && $params['month'] == $i) echo 'selected'; ?>><?= $i ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="select-year">Select year:</label>
                                                <select class="form-control" id="select-year">
                                                    <option value="0">Select Year</option>
                <?php for ($i = 2016;
                        $i <= date('Y'); $i++) { ?>
                                                        <option value="<?= $i ?>" <?php if (isset($params['year']) && $params['year'] == $i) echo 'selected'; ?>><?= $i ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>-->

                <div class="clearfix"></div>

                <div id="table_container">
                    <table class="table table-bordered table-referral">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Login</th>
                            <th>Register Time</th>
                        </tr>
                    <?php foreach ($referralList as $row) { ?>
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{date('Y-m-d H:i:s', $row->last_login)}}</td>
                            <td>{{$row->created_at->toDateString()}}</td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>

                <div class="DT-pagination">
                    <?php echo $referralList->render() ?>
                </div>

            </div>

            <div class="clearfix"></div>
            <br>
        </div>
        <!-- End My Referral -->




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
                        <li><a href="{{asset('user/profile')}}">Profile</a></li>
                        <li><a href="{{asset('user/referral')}}" class="active">Referral</a></li>
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