@extends('admin.master')

@section('content')

<div class="page-header" id="page-title">

    <h1>Update User</h1>
    <div class="pull-right" id="top-righ-icon">
        <a class="btn btn-dark" title="" data-toggle="tooltip" href="{{ url('/admin/user') }}" data-placement="bottom" data-original-title="Back"><i class="fa fa-reply"></i></a>
    </div>
    <script>
        init.push(function () {
            $('#top-righ-icon a').tooltip();
        });
    </script>
</div> <!-- / .page-header -->

<div>
    <ul class="breadcrumb">
        <li><a href="{{ url('admin') }}">Home</a></li>
        <li><a href="{{ url('admin/user') }}">Users</a></li>
        <li class="active">Profile</li>
    </ul>
</div>
@include('errors.alert')
<form class="panel form-horizontal"  id="create_form"
      method="post" enctype="multipart/form-data"
      action="{{ URL::to('admin/user/edit') }}"
      autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="id" value="{{ $user->id }}" />
    <div class="panel-heading">


        <span class="panel-title active"> <i class="panel-title-icon fa fa-edit"></i> Profile</span>
        <!--<span class="panel-title"> <i class="panel-title-icon fa fa-link"></i> Referal</span>-->
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><span class="fa fa-user"></span> Update Profile</a></li>
            <li><a data-toggle="tab" href="#referral"><span class="fa fa-sitemap"></span> Referral</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="col-lg-9">
                    <form class="form-horizontal my_profile" method="post" action="{{url('admin/user/edit')}}">
                        <input type="hidden" name="id" value="{{ $user->id }}" />
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
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        ?>
                                        <option value="<?= $i ?>" <?php if ($user->birthday->day == $i) echo 'selected'; ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select name="birthday-month" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        ?>
                                        <option value="<?= $i ?>" <?php if ($user->birthday->month == $i) echo 'selected'; ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select name="birthday-year" class="form-control">
                                    <?php
                                    for ($i = 1930; $i <= 2016; $i++) {
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
                            <label for="inputLocation" class="control-label col-xs-3">Location</label>
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
            </div>
            <div id="referral" class="tab-pane fade">
                <div class="col-xs-12 my-referral">
                    <h2>Referral URL: <a href="http://apps.com.mm/r/{{$user->referral_key}}">http://apps.com.mm/r/{{$user->referral_key}}  </a></h2>
                    <div class="clearfix"></div>

<!--                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="select-month">Select month:</label>
                            <select class="form-control" id="select-month">
                                <option value="0">Select Month</option>
                                <?php for ($i = 1;
                                        $i <= 12; $i++) { ?>
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
            </div>

        </div>




    </div>
</form>

<script>
    init.push(function () {
        if (!$('html').hasClass('ie8')) {
            $('#summernote-example').summernote({
                height: 400,
                tabsize: 2,
                codemirror: {
                    theme: 'monokai'
                }
            });
        }
    })
    function submitForm() {
        $("#create_form").submit();
    }

    function changePage(page) {
        $.ajax({
            url: "{{url('admin/user/getReferral').'/'.$user->id}}?page=" + page,
            data: {
                'month': $("#select-month").val(),
                'year': $("#select-year").val()
            }
        }).done(function (data) {
            $("#table_container").html(data);
            $(".page").removeClass('active');
            $(".page." + page).addClass('active');
        }).fail(function () {
            alert('Data could not be load.');
        })
    }

    $(document).ready(function () {
        $('.pagination li').last().removeClass('disabled').addClass('page last').html('<a href="javascript:void(0)" rel="next" onclick="changePage({{$referralList->lastPage()}})">»</a>');
        $('.pagination li').first().removeClass('disabled').addClass('page first').html('<a href="javascript:void(0)" rel="next" onclick="changePage(1)">«</a>');
        $('.pagination li').each(function (index, element) {
            link = $(element).find('a').attr('href');
            $(element).find('a').attr('href', 'javascript:void(0)');
            if (typeof(link) != 'undefined') {
                page = link.substring(link.indexOf('page=') + 5);
                if (parseInt(page) > 0) {
                    $(element).find('a').attr('onclick', 'changePage(' + page + ')').parent().addClass('page ' + page);
                }
            } else {
                page = $(element).find('span').html();
                $(element).html('<a href="javascript:void(0)" rel="next" onclick="changePage(' + page + ')">' + page + '</a>').addClass('page ' + page);
            }
        })
    })
</script>


@endsection