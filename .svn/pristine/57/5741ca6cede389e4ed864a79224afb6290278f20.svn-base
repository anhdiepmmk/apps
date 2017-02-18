@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Versions no Download Link</h1>
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
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i> List</span>
        </div>
        <div>
            <form action="{{ URL::to('/admin/app/deleteall') }}" id="adminForm" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                <thead>
                    <tr>
                        <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                        <th>ID</th>
                        <th>App Name</th>
                        <th>Version</th>
                        <th>Filename</th>
                        <th class="text-center">Version Updated</th>
                        <th class="text-center" style="width:15ex">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions_nodllink as $row)
                        <tr>
                            <td><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                            <td>{{ $row->appversion->id }}</td>
                            <td>{{ $row->appversion->app->name }}</td>
                            <td>{{ $row->appversion->name }}</td>
                            <td>{{ $row->filename }}</td>

                            <td class="text-center">{{ $row->appversion->version_updated->format('Y-m-d') }}</td>
                            <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                <?php
                                    $editurl = url('admin/app/'.$row->appversion->app->id.'/version/'.$row->appversion->id.'/edit');
                                ?>
                                {!! icon_edit($editurl) !!}
                                {!! icon_del($row->appversion->id) !!}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="table-footer clearfix" style="border: 0px; margin-top: 0px">
                <div class="DT-label">Hiện có {{ $versions_nodllink->total() }} record</div>
                <div class="DT-pagination">
                    {!! $versions_nodllink->render() !!}
                </div>
            </div>
            </form>

        </div>
    </div>


<script>
    function del(id){
        bootbox.confirm({
            message: "Bạn có chắc là muốn xóa Version này không?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/app/version/delete') }}";
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