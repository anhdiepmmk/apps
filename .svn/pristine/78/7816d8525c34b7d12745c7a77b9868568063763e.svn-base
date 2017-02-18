@extends('admin.master')

@section('content')

    <div class="page-header" id="page-title">

	    <h1>Add New Version</h1>
	    <div class="pull-right" id="top-righ-icon">

            <a class="btn btn-primary" title="" data-toggle="tooltip" onclick="submitForm()" href="javascript:;" data-placement="bottom" data-original-title="Lưu"><i class="fa fa-save"></i></a>
            <a class="btn btn-dark" title="" data-toggle="tooltip" href="{{ url('/admin/app/'.$app->id.'/version') }}" data-placement="bottom" data-original-title="Quay lại"><i class="fa fa-reply"></i></a>
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
            <li><a href="{{ url('admin/app') }}">Apps</a></li>
            <li><a href="{{ url('admin/app/'.$app->id.'/edit') }}">{{ $app->name }}</a></li>
            <li class="active">Add New Version</li>
        </ul>
    </div>
    @include('errors.alert')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-plus"></i> Add New</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal"  id="create_form"
            method="post" enctype="multipart/form-data"
            action="{{ URL::to('admin/app/'.$app->id.'/version/create') }}"
            autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="app_id" value="{{ $app->id }}" />
                <div class="form-group">
                    <label class="col-sm-2 control-label">Link Google Play</label>
                    <div class="col-sm-10">
                        <input type="text" readonly="readonly" value="{{ $app->link }}" class="form-control" placeholder="Version">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Version</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if( $errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Verion Updated</label>
                    <div class="col-sm-10">
                        <div class="input-group date" id="bs-datepicker-component">
                            <input type="text" class="form-control" name="version_updated" value=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">OS Request</label>
                    <div class="col-sm-10">
                            <input type="text" class="form-control" name="minos" value="{{ old('minos') }}">
                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload File</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" id="tuychon" name="tuychon" class="px" value="link" checked="checked"> <span class="lbl">Sử dụng link </span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" id="tuychon" name="tuychon" class="px" value="file"> <span class="lbl">Upload file </span>
                            </label>
                        </div>
                        <div id="div_link">
                            <label class="control-label">Link file</label>
                            <input type="text" name="apklink" class="form-control" placeholder="Link file">
                        </div>
                        <div id="div_file" style="display: none;">
                            <label class="control-label">Upload từ máy tính</label>
                            <script>
                                init.push(function () {
                                    $('#styled-finputs-example').pixelFileInput({ placeholder: 'No file selected...' });
                                })
                            </script>
                            <input type="file" name="apkfile" id="styled-finputs-example">
                        </div>
                        <div>
                            @if( $errors->has('apkfile'))
                                <div class="alert alert-danger" style="margin-top: 5px; padding: 5px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ $errors->first('apkfile') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!--
                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload File</label>
                    <div class="col-sm-10">
                        <script>
                            init.push(function () {
                                $('#apkfile').pixelFileInput({ placeholder: 'No file selected...' });
                            })
                        </script>
                        <input type="file" name="apkfile" id="apkfile">
                        @if( $errors->has('apkfile'))
                            <div class="alert alert-danger" style="margin-top: 5px; padding: 5px">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ $errors->first('apkfile') }}
                            </div>
                        @endif
                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tính năng mới</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summernote-example" name="what_new">{{ old('what_new') }}</textarea>
                    </div>
                </div> <!-- / .form-group -->
            </form>


        </div>
    </div>
    <script>
        init.push(function () {
            if (! $('html').hasClass('ie8')) {
                $('#summernote-example').summernote({
                    height: 400,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }

            var options = {
                todayBtn: "linked",
                orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto'
            }
            $('#bs-datepicker-example').datepicker(options);

            $('#bs-datepicker-component').datepicker({
                format: 'yyyy-mm-dd'
            });

            $("input.px").click(function(){
                value_ = $(this).val();
                if(value_ == 'file'){
                    $("#div_file").show();
                    $("#div_link").hide();
                }else{
                    $("#div_file").hide();
                    $("#div_link").show();
                }
            })

        })
        function submitForm(){
            $("#create_form").submit();
        }
    </script>


@endsection