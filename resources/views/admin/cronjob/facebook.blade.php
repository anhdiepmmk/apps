@extends('admin.master')

@section('content')

    <div class="page-header" id="page-title">

	    <h1>Thông tin Facebook</h1>
	    <div class="pull-right" id="top-righ-icon">

            <a class="btn btn-primary" title="" data-toggle="tooltip" onclick="submitForm()" href="javascript:;" data-placement="bottom" data-original-title="Lưu"><i class="fa fa-save"></i></a>
        </div>
        <script>
            init.push(function () {
                $('#top-righ-icon a').tooltip();
            });
        </script>
    </div> <!-- / .page-header -->

    <div>
        @include('errors.alert')
    </div>
    <form class="panel form-horizontal"  id="create_form"
	method="post"
	action="{{ URL::to('admin/facebook') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-edit"></i> Facebook Info</span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                    <label class="col-sm-2 control-label">App ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="facebook[app_id]" value="{{ $facebook['app_id'] }}" class="form-control" placeholder="App ID">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">App Secret</label>
                    <div class="col-sm-10">
                        <input type="text" name="facebook[app_secret]" value="{{ $facebook['app_secret'] }}" class="form-control" placeholder="App Secret">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Access Token</label>
                    <div class="col-sm-8">
                        <input type="text" name="facebook[access_token]" value="{{ $facebook['access_token'] }}" class="form-control" readonly placeholder="Access Token">
                    </div>
                    <div class="col-sm-2">
                        <button onclick="getToken()" class="btn btn-primary" style="width: 100%" type="button">Get Access Token</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Page Id</label>
                    <div class="col-sm-10">
                        <input type="text" name="facebook[page_id]" value="{{ $facebook['page_id'] }}" class="form-control" placeholder="Page Id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Page Admin User Id</label>
                    <div class="col-sm-10">
                        <input type="text" name="facebook[page_admin]" value="{{ $facebook['page_admin'] }}" class="form-control" placeholder="Page Admin User Id">
                    </div>
                </div>

        </div>
    </form>

    <script>
        function submitForm(){
            $("#create_form").submit();
        }

        function getToken(){
            window.location = "{{ url('admin/facebook/getfbtoken')  }}";
        }
    </script>

@endsection