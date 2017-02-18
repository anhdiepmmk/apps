@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Contact</h1>
	    <div class="pull-right" id="top-righ-icon">
            <a class="btn btn-danger" onclick="submitAdminForm()" href="javascript:;" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Xóa"><i class="fa fa-trash-o"></i></a>
        </div>
        <script>
            init.push(function () {
                $('#top-righ-icon a').tooltip();
                $('#action_colum a').tooltip();
            });
        </script>
    </div> <!-- / .page-header -->
    <div>
        @include('errors.alert')
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i> Contact</span>
        </div>
        <div>
            <form action="{{ URL::to('/admin/contact/deleteall') }}" id="adminForm" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                <thead>
                    <tr>
                        <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Reason</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th class="text-center" style="width:15ex">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $row)
                        <tr>
                            <td class="valign-middle"><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                            <td class="valign-middle text-semibold">{{ $row->name }}</td>
                            <td class="valign-middle">{{ $row->email }}</td>
                            @if($row->reason == 1)
                                <td class="valign-middle">Website Feedback</td>
                            @elseif($row->reason == 2)
                                <td class="valign-middle">DCMA</td>
                            @elseif($row->reason == 3)
                                <td class="valign-middle">Other</td>
                            @endif
                            <td class="valign-middle">{{ $row->subject }}</td>
                            <td class="valign-middle">{!!  $row->message  !!}</td>
                            <td class="valign-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                            <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                <?php
                                    $view_url = url('admin/contact/'.$row->id)
                                ?>
                                <!-- {!! icon_view($view_url) !!} -->
                                {!! icon_del($row->id) !!}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            </form>
        </div>
    </div>


<script>


    function del(id){
        bootbox.confirm({
            message: "Bạn có chắc là muốn xóa Danh mục này không?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/contact/delete') }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        }

                    }).done(function(){
                        location.reload();
                    });
                }
            },
            className: "bootbox-sm"
        });
    }



</script>
@endsection