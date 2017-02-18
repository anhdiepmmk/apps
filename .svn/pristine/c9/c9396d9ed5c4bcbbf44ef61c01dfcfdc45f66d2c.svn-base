@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Report Link Die</h1>
        <script>
            init.push(function () {
                $('#action_colum a').tooltip();
            });
        </script>

    </div> <!-- / .page-header -->
    <div>
        @include('errors.alert')
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i> Die Download Link</span>
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
                        <th class="text-center">Report Count</th>
                        <th class="text-center">Lasted Report</th>
                        <th class="text-center" style="width:15ex">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions as $row)
                        <tr>
                            <td><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ url('admin/app/'.$row->app->id.'/version') }}">{{ $row->app->name .' '.$row->name }}</a></td>
                            <td>{{ ($row->appfiles) ? $row->appfiles->filename : '' }}</td>
                            <td>
                                {{ ($row->appfiles) ? human_filesize($row->appfiles->filesize) : '' }}
                            </td>
                            </td>
                            <td class="text-center">{{ $row->report }}</td>
                            <td class="text-center">{{ $row->report_at->format('Y-m-d') }}</td>
                            <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                <?php
                                    $editurl = url('admin/app/'.$row->app->id.'/version/'.$row->id.'/edit')
                                ?>
                                {!! icon_edit($editurl) !!}
                                {!! icon_fix($row->id) !!}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            </form>

        </div>
    </div>


<script>
    function fix(id){
        bootbox.confirm({
            message: "Bạn có chắc là muốn fix Version này không?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/app/version/fix') }}";
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