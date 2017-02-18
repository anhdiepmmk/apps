@extends('admin.master')



@section('content')

    <div class="page-header" id="page-title">

	    <h1>New Page</h1>
	    <div class="pull-right" id="top-righ-icon">

            <a class="btn btn-primary" title="" data-toggle="tooltip" onclick="submitForm()" href="javascript:;" data-placement="bottom" data-original-title="Lưu"><i class="fa fa-save"></i></a>
            <a class="btn btn-dark" title="" data-toggle="tooltip" href="{{ url('/admin/pages') }}" data-placement="bottom" data-original-title="Quay lại"><i class="fa fa-reply"></i></a>
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
            <li><a href="{{ url('admin/pages') }}">Pages</a></li>
            <li class="active">Tạo Mới</li>
        </ul>
    </div>

    <form class="panel form-horizontal"  id="create_form"
	method="post"
	action="{{ URL::to('admin/pages/create') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-plus"></i> Create new Page</span>
        </div>
        <div class="panel-body">

            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name" class="col-sm-2 control-label">Tiêu đề</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    @if( $errors->has('title'))
                        <p class="help-block">{{ $errors->first('title') }}</p>
                    @endif

                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Nội dung</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="summernote-example" name="noidung">{{ old('noidung') }}</textarea>
                </div>
            </div> <!-- / .form-group -->
        </div>
    </form>

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
        })

        function submitForm(){
            $("#create_form").submit();
        }
    </script>

@endsection