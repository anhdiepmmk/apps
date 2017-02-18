@extends('admin.master')



@section('content')

    <div class="page-header" id="page-title">
	    <h1>Kiểm tra Version</h1>
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
                <div class="col-md-4">
                    <select id="cat_id" name="cat_id" class="form-control">
                        <option value="0">Tất Cả Danh Mục</option>
                        @foreach($mainCategories as $row)
                            <optgroup label="{{ $row->name }}"></optgroup>
                            {{ $categories = \App\Category::getChildCategories($row->id) }}
                            @foreach($categories as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <button type="button" id="clickauto" class="btn btn-primary">Check Version</button>
                </div>
            </div> <!-- / .form-group -->

            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="">0%</div>
            </div>
            <div id="msg_box">

            </div>


        </div>
    </form>




    <script type="text/javascript">
        $(document).ready(function($) {
            $("#clickauto").click(function(){
                postSession();
                $(".progress-bar").css({width:'0'});
                $(".progress-bar").attr("aria-valuenow","0");
            })
        })

        function postSession(){
            var cat_id = $('#cat_id').val();
            var url = "{{ url('/admin/checkversionsession') }}";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    cat_id: cat_id,
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.status == 1 ){
                        cron();
                    }
                },
                async: false
            });
        }

        function cron(){
            var url = "{{ url('/admin/checkversion') }}";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.jobsleft == 0){
                        $('.progress-bar').html('100%');
                        $(".progress-bar").css({width:'100%'});
                        $(".progress-bar").attr("aria-valuenow","100");
                        $('#msg_box').html('Done');
                        return false;
                    } else {
                        $('.progress-bar').html(data.percentjob+'%');
                        $(".progress-bar").css({'width':data.percentjob+'%'});
                        $(".progress-bar").attr("aria-valuenow",data.percentjob);
                        $('#msg_box').html(data.msg);
                        cron();
                    }
                }
            });

        }

    </script>

@endsection