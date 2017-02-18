@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Quản lý Versions</h1>
	    <div class="pull-right" id="top-righ-icon">
            <a class="btn btn-primary" title="" data-toggle="tooltip" href="{{ url('admin/app/'.$app->id.'/version/create') }}" data-placement="bottom" data-original-title="Thêm mới"><i class="fa fa-plus"></i></a>
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
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i> List Version App: <strong>{{ $app->name }}</strong></span>
        </div>
        <div>
            <form action="{{ URL::to('/admin/app/deleteall') }}" id="adminForm" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                <thead>
                    <tr>
                        <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                        <th>ID</th>
                        <th>Version</th>
                        <th>Filename</th>
                        <th>Filesize</th>
                        <th class="text-center">File Downloads</th>
                        <th class="text-center">Version Updated</th>
                        <th class="text-center" style="width:15ex">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions as $row)
                        <tr>
                            <td><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ ($row->appfiles) ? $row->appfiles->filename : '' }}</td>
                            <td>
                                {{ ($row->appfiles) ? human_filesize($row->appfiles->filesize) : '' }}
                            </td>
                            </td>
                            <td class="text-center"><i class="fa fa-cloud-download"></i></td>
                            <td class="text-center">{{ $row->version_updated->format('Y-m-d') }}</td>
                            <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                <?php
                                    $editurl = url('admin/app/'.$app->id.'/version/'.$row->id.'/edit')
                                ?>
                                {!! icon_edit($editurl) !!}
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
            message: "Bạn có chắc là muốn xóa Version này không?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/app/'.$app->id.'/version/delete') }}";
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