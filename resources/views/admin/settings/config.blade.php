@extends('admin.master')

@section('content')

    <div class="page-header" id="page-title">

	    <h1>Thông tin Webiste</h1>
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
        <ul class="breadcrumb">
            <li><a href="{{ url('admin') }}">Home</a></li>
            <li class="active">Config</li>
        </ul>
    </div>
    <div>
        @include('errors.alert')
    </div>
    <form class="panel form-horizontal"  id="create_form"
	method="post"
	action="{{ URL::to('admin/settings/config') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-edit"></i> Config</span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                    <label class="col-sm-2 control-label">Site Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[site_name]" value="{{ $configs['site_name'] }}" class="form-control" placeholder="Site name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input required email type="text" name="configs[email]" value="{{ $configs['email'] }}" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Miêu tả</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[des]" value="{{ $configs['des'] }}" class="form-control" placeholder="Miêu tả">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Từ khóa</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[keyword]" value="{{ $configs['keyword'] }}" class="form-control" placeholder="Từ khóa">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Facebook page</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[facebook]" value="{{ $configs['facebook'] }}" class="form-control" placeholder="Facebook page">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Google Plus</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[google]" value="{{ $configs['google'] }}" class="form-control" placeholder="Google Plus">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Twitter</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[twitter]" value="{{ $configs['twitter'] }}" class="form-control" placeholder="twitter">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Google Analytics</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[analytics]" value="{{ $configs['analytics'] or '' }}" class="form-control" placeholder="Google Analytics">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Google Webmaster</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[webmaster]" value="{{ $configs['webmaster'] or '' }}" class="form-control" placeholder="Google Webmaster">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Bing</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[bing]" value="{{ $configs['bing'] or '' }}" class="form-control" placeholder="Bing">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Alexa</label>
                    <div class="col-sm-10">
                        <input type="text" name="configs[alexa]" value="{{ $configs['alexa'] or '' }}" class="form-control" placeholder="Alexa">
                    </div>
                </div>
        </div>
    </form>

    <script>
        function submitForm(){
            $("#create_form").submit();
        }
    </script>

@endsection