@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])

@section('content')
        <!-- Modal -->
        <div class="modal-md no_shadow" id="register" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <h4 class="modal-title">Register</h4>
                        <div class="modal_logo"><img src="{{asset('resources/assets/home/img/wlogo.png')}}" /></div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <?php if(session('error')) { ?>
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                <?php } ?>
                                <form class="form-horizontal" method="post" action="/user/register">
                                    <div class="form-group">
                                        <label for="inputName" class="control-label col-xs-3">Name</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" id="inputName" value="{{$userData['name']}}" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label col-xs-3">Email</label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control" id="inputEmail" value="{{$userData['email']}}" name="email" placeholder="Email">
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
                                            <input type="password" class="form-control" id="inputConfirmPassword" name="confirmPassword" placeholder="Password">
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="referralKey" value="{{$userData['referralKey']}}">
                                    <div class="form-group">
                                        <label for="inputBirthday" class="control-label col-xs-3">Birthdate</label>
                                        <div class="col-xs-3">
                                            <select name="birthday-day" class="form-control">
                                                <?php for($i = 1; $i <= 31; $i++) { ?>
                                                <option <?php if ($userData['birthday']['day'] == $i) echo 'selected'; ?> value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <select name="birthday-month" class="form-control">
                                                <?php for($i = 1; $i <= 12; $i++) { ?>
                                                <option <?php if ($userData['birthday']['month'] == $i) echo 'selected'; ?> value="<?=$i?>"><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <select name="birthday-year" class="form-control">
                                                <?php for($i = 1930; $i <= 2016; $i++) { ?>
                                                <option value="<?=$i?>" <?php if ($userData['birthday']['year'] == $i) echo 'selected'; ?> <?php if($i == 1990 && empty($userData['birthday']['month'])) echo 'selected'; ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSex" class="control-label col-xs-3">Sex</label>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" <?php if ($userData['sex'] == 'none') echo 'checked'; ?>  <?php if (empty($userData['sex'])) echo 'checked'; ?> value="none"> None
                                            </label>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" <?php if ($userData['sex'] == 'male') echo 'checked'; ?> value="male"> Male
                                            </label>
                                        </div>
                                        <div class="col-xs-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" <?php if ($userData['sex'] == 'female') echo 'checked'; ?> value="female"> Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="control-label col-xs-3">Location</label>
                                        <div class="col-xs-9">
                                            <select name="location" class="form-control">
                                                <option <?php if ($userData['location'] == 'Yangon') echo 'selected' ?> value="Yangon">Yangon</option>
                                                <option <?php if ($userData['location'] == 'Mandalay') echo 'selected' ?> value="Mandalay">Mandalay</option>
                                                <option <?php if ($userData['location'] == 'Naypyitaw') echo 'selected' ?> value="Naypyitaw">Naypyitaw</option>
                                                <option <?php if ($userData['location'] == 'Ayeyarwaddy') echo 'selected' ?> value="Ayeyarwaddy">Ayeyarwaddy</option>
                                                <option <?php if ($userData['location'] == 'Bago') echo 'selected' ?> value="Bago">Bago</option>
                                                <option <?php if ($userData['location'] == 'Chin') echo 'selected' ?> value="Chin">Chin</option>
                                                <option <?php if ($userData['location'] == 'Kayah') echo 'selected' ?> value="Kayah">Kayah</option>
                                                <option <?php if ($userData['location'] == 'Kayin') echo 'selected' ?> value="Kayin">Kayin</option>
                                                <option <?php if ($userData['location'] == 'Kachin') echo 'selected' ?> value="Kachin">Kachin</option>
                                                <option <?php if ($userData['location'] == 'Magway') echo 'selected' ?> value="Magway">Magway</option>
                                                <option <?php if ($userData['location'] == 'Mon') echo 'selected' ?> value="Mon">Mon</option>
                                                <option <?php if ($userData['location'] == 'Rakhine') echo 'selected' ?> value="Rakhine">Rakhine</option>
                                                <option <?php if ($userData['location'] == 'Sagaing') echo 'selected' ?> value="Sagaing">Sagaing</option>
                                                <option <?php if ($userData['location'] == 'Shan') echo 'selected' ?> value="Shan">Shan</option>
                                                <option <?php if ($userData['location'] == 'Tanintharyi') echo 'selected' ?> value="Tanintharyi">Tanintharyi</option>
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
                                            <p class="fs-12">Already a member? <a href="/user/login" >Login</a></p>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>





<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

</script>


@endsection