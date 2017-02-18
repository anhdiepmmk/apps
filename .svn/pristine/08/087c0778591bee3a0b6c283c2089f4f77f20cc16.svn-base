@extends('admin.master')



@section('content')

    <div class="page-header" id="page-title">

	    <h1>Thêm mới Danh mục</h1>
	    <div class="pull-right" id="top-righ-icon">

            <a class="btn btn-primary" title="" data-toggle="tooltip" onclick="submitForm()" href="javascript:;" data-placement="bottom" data-original-title="Lưu"><i class="fa fa-save"></i></a>
            <a class="btn btn-dark" title="" data-toggle="tooltip" href="{{ url('/admin/category') }}" data-placement="bottom" data-original-title="Quay lại"><i class="fa fa-reply"></i></a>
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
            <li><a href="{{ url('admin/category') }}">Danh Mục</a></li>
            <li class="active">Tạo Mới</li>
        </ul>
    </div>

    <form class="panel form-horizontal"  id="create_form"
	method="post"
	action="{{ URL::to('admin/category/create') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-plus"></i> Thêm mới Danh mục</span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Danh Mục Cha</label>
                <div class="col-sm-10">
                    <select name="parent_id" class="form-control">
                        <option value="0">Là Danh Mục Cha</option>
                        @foreach($mainCategories as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-sm-2 control-label">Tên danh mục</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @if( $errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
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
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" placeholder="" value="{{ old('description') }}">
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Keyword</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="keyword" placeholder="" value="{{ old('keyword') }}">
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Sắp xếp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ordering" placeholder="" value="{{ old('ordering') }}">
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="link" placeholder="" value="{{ old('link') }}">
                </div>
            </div> <!-- / .form-group -->
        </div>
    </form>

    <script>
        function submitForm(){
            $("#create_form").submit();
        }
    </script>

@endsection