@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])

@section('content')

<!-- Modal -->
<div class="modal-md no_shadow" id="signin">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title">Welcome to</h4>
                <div class="modal_logo"><img src="{{asset('resources/assets/home/img/wlogo.png')}}" /></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <?php if(session('error')) { ?>
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        <?php } ?>
                        <form method="post" action="/user/login">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$params['email']}}" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label class="checkbox-inline"><input type="checkbox" name="remember" <?php if($params['remember'] == 1) echo 'checked'; ?> value="1"><b>Remember me</b></label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-success">Login</button>
                            </div>
                            <input type="hidden" name="redirectTo" value="{{ $params['redirectTo'] }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p class="fs-12">Forgot password? <a href="" >Click here</a></p>
                                <p class="fs-12">Need an account? <a href="/user/register">Sign Up here</a></p>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



<!-- Modal -->






<script>
    $(document).ready(function () {
        $("#currentPage").val(1);
    });

</script>


@endsection