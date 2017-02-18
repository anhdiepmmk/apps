@extends('admin.master')

@section('content')

    <div class="page-header" id="page-title">

	    <h1>Create New App</h1>
	    <div class="pull-right" id="top-righ-icon">

            <a class="btn btn-primary" title="" data-toggle="tooltip" onclick="submitForm()" href="javascript:;" data-placement="bottom" data-original-title="Lưu"><i class="fa fa-save"></i></a>
            <a class="btn btn-dark" title="" data-toggle="tooltip" href="{{ url('/admin/app') }}" data-placement="bottom" data-original-title="Quay lại"><i class="fa fa-reply"></i></a>
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
            <li class="active">Create New</li>
        </ul>
    </div>
    @include('errors.alert')
    <form class="panel form-horizontal"  id="create_form"
	method="post" enctype="multipart/form-data"
	action="{{ URL::to('admin/app/create') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-edit"></i> Nhập Dữ Liệu</span>
        </div>
        <div class="panel-body">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Chọn Danh Mục</label>
                    <div class="col-sm-10">
                        <select id="cat_id" name="cat_id" class="form-control">
                            @foreach($mainCategories as $row)
                                <optgroup label="{{ $row->name }}"></optgroup>
                                {{ $categories = \App\Category::getChildCategories($row->id) }}
                                @foreach($categories as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Tên</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if( $errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                    <label for="slug" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                        @if( $errors->has('slug'))
                            <p class="help-block">{{ $errors->first('slug') }}</p>
                        @endif

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group {{ $errors->has('developer') ? 'has-error' : '' }}">
                    <label for="slug" class="col-sm-2 control-label">Developer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="developer" value="{{ old('developer') }}">
                        @if( $errors->has('slug'))
                            <p class="help-block">{{ $errors->first('slug') }}</p>
                        @endif

                    </div>
                </div> <!-- / .form-group -->

                <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                    <label for="slug" class="col-sm-2 control-label">Google Link</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                        @if( $errors->has('link'))
                            <p class="help-block">{{ $errors->first('link') }}</p>
                        @endif

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tùy chọn</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="featured" class="px" value="1"> <span class="lbl">Nổi bật</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 text-left">Nội dung</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="summernote-example" name="contentapp"></textarea>
                    </div>
                </div>

            </div>


            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hình đại diện</h3>
                    </div>
                    <div class="panel-body">
                        <script>
                            init.push(function () {
                                $('#styled-finputs-example').pixelFileInput({ placeholder: 'No file selected...' });
                            })
                        </script>
                        <input type="file" name="image" id="styled-finputs-example">
                        @if( $errors->has('image'))
                            <div class="alert alert-danger" style="margin-top: 5px; padding: 5px">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group no-margin-hr">
                    <label class="control-label">Từ khóa</label>
                    <textarea class="form-control" name="keyword"></textarea>
                </div>
                <div class="form-group no-margin-hr">
                    <label class="control-label">Miêu tả</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>

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