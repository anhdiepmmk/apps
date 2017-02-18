@extends('admin.master')



@section('content')

    <div class="page-header" id="page-title">
	    <h1>Lấy 1 Bài mới</h1>
    </div> <!-- / .page-header -->

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ url('admin') }}">Home</a></li>
            <li class="active">Cronjob</li>
        </ul>
    </div>

    <form class="panel form-horizontal"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-plus"></i> Điền thông tin</span>
        </div>
        <div class="panel-body">
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
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Link Google</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                </div>
            </div> <!-- / .form-group -->

            <div id="msg_box" class="col-sm-offset-2 col-sm-10">

            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" onclick="postCron()" class="btn btn-primary">Go</button>
            </div>

        </div>
    </form>

    <script>
        function postCron()
        {
            var cat_id = $('#cat_id').val();
            var link = $('#link').val();
            var url = "{{ url('/admin/cronone') }}";
            $('#msg_box').html('Hệ thống đang lấy dữ liệu, Xin vời lòng đợi ...');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    cat_id: cat_id,
                    link: link
                },
                dataType: 'json',
                success: function(data){
                    $('#msg_box').html(data.msg);
                    console.log(data);
                },
                async: false
            });
        }
    </script>

@endsection