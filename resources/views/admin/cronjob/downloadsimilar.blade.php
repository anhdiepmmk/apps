@extends('admin.master')



@section('content')

    <div class="page-header" id="page-title">
	    <h1>Transfer Server</h1>
    </div> <!-- / .page-header -->

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ url('admin') }}">Home</a></li>
            <li class="active">Cron Download File to FTP</li>
        </ul>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"> <i class="panel-title-icon fa fa-plus"></i> Thông Tin</span>
        </div>
        <div class="panel-body">
            <form class="form-horizontal"
            	autocomplete="off">
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Tổng Apps chưa lấy</label>
                    <div class="col-sm-9" id="total_left">

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">App vừa cron</label>
                    <div class="col-sm-9" id="app_done">

                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Trạng Thái</label>
                    <div class="col-sm-9" id="msg_box">

                    </div>
                </div> <!-- / .form-group -->
                <div class="col-md-10 col-md-offset-3">
                    <button type="button" id="clickauto" class="btn btn-primary">Get Similar Apps</button>
                </div>

            </form>
            <div id="cron_result">

            </div>

        </div>
    </div>




    <script type="text/javascript">
           $(document).ready(function($) {
               $("#clickauto").click(function(){
                   postSession();
               })
           })

           function postSession(){
               var url = "{{ url('admin/similarsession') }}";
               $.ajax({
                   type: 'POST',
                   url: url,
                   data: {
                       _token: "{{ csrf_token() }}",
                   },
                   dataType: 'json',
                   success: function(data){
                       console.log(data);
                       if(data.status == 1 ){
                           cron();
                           html = '<div id="status_'+data.next_cron_id+'"><i class="fa fa-spinner fa-pulse"> </i>  '+data.next_cron+'</div>';
                           $("#cron_result").append(html);
                       }
                   },
                   async: false
               });
           }

           function cron(){
               var url = "{{ url('/admin/similar') }}";
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
                           $('#msg_box').html('Done');
                           return false;
                       } else {
                           $('#msg_box').html(data.msg);
                           $('#total_left').html(data.total_left);
                           $('#app_done').html(data.app_done);

                           html = '<i class="fa fa-check"> </i>  ' + data.app_done +' <b>Status</b>:  ' + data.msg;
                           $("#status_"+data.app_done_id).html(html);
                           cron();
                           html2 = '<div id="status_'+data.next_cron_id+'"><i class="fa fa-spinner fa-pulse"> </i>  '+data.next_cron+'</div>';
                           $("#cron_result").append(html2);
                       }
                   }
               });

           }

       </script>

@endsection