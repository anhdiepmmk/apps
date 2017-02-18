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
                <h4 class="modal-title">Reset Password</h4>
                <div class="modal_logo"><img src="{{asset('resources/assets/home/img/wlogo.png')}}" /></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <form>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-4">Password</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-4">Password (again)</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-block btn-success">Update Password</button>
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






<script>
    $(document).ready(function () {
        $("#currentPage").val(1);
    });

</script>


@endsection