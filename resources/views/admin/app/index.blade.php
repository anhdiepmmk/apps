@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Apps Management</h1>
	    <div class="pull-right" id="top-righ-icon">
            <a class="btn btn-primary" title="" data-toggle="tooltip" href="{{ url('admin/app/create') }}" data-placement="bottom" data-original-title="Thêm mới"><i class="fa fa-plus"></i></a>
            <a class="btn btn-danger" onclick="submitAdminForm()" href="javascript:;" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Xóa"><i class="fa fa-trash-o"></i></a>
        </div>
        <script>
            init.push(function () {
                $('#top-righ-icon a').tooltip();
                $('#action_colum a').tooltip();
                $('#vwd_select').change(function(){
                    $("#select_vwd_form").submit();
                });
            });
        </script>
    </div> <!-- / .page-header -->
    <div>
        @include('errors.alert')
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i>&nbsp;Apps List</span>
            <div class="panel-heading-controls" style="max-width: 50%">
                <form action="" method="GET" id="select_vwd_form">
                    <div class="input-group input-group-sm">
                        <select class="form-control form-group-margin" name="vwd" id="vwd_select">
                            <option value="0">App Filter</option>
                            <option value="1">Varies With Device</option>
                        </select>
                    </div> <!-- / .input-group -->
                </form>
            </div>
        </div>
        <div class="panel-body">

            <div>
                <form action="" method="GET">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search by name..." name="search">
                        <span class="input-group-btn">
                            <button class="btn" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div> <!-- / .input-group -->
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <div>
                <form action="{{ URL::to('/admin/app/deleteall') }}" id="adminForm" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                    <thead>
                        <tr>
                            <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>App Name</th>
                            <th>Last Version</th>
                            <th>Statistic</th>
                            <th>Category</th>
                            <th class="text-center" style="width:15ex">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apps as $row)
                            <tr>
                                <td class="valign-middle"><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                                <td class="valign-middle">{{ $row->id }}</td>
                                <td class="valign-middle"><img src="{{ asset('storage/'.$row->path.'/60/'.$row->image) }}" /></td>
                                <td class="valign-middle">{{ $row->name }}</td>
                                <td>
                                    <a href="#">{{ ($version = $row->versions->last())? $version->name : "" }}</a><br/>

                                    <a href="{{ url('admin/app/'.$row->id.'/version') }}">
                                        List Version
                                        @if($row->varieswithdevice == 1)
                                            <i class="fa fa-android"></i>
                                        @endif
                                    </a>

                                </td>
                                <td class="valign-middle">
                                    <i class="fa fa-clock-o"></i> {{ $row->views }}
                                    <i class="fa fa-cloud-download"></i> {{ $row->numDownloads  }}
                                </td>
                                <td class="valign-middle">{{ $row->category->name }}</td>
                                <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                    <?php
                                        $editurl = url('admin/app').'/'.$row->id.'/edit';
                                    ?>
                                    {!! icon_edit($editurl) !!}
                                    {!! icon_active("'apps'","'noupdate'", $row->id, $row->noupdate) !!}
                                    {!! icon_del($row->id) !!}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="table-footer clearfix" style="border: 0px; margin-top: 0px">
                    <div class="DT-label">Hiện có {{ $apps->total() }} record</div>
                    <div class="DT-pagination">
                        {!! $apps->appends(Request::only('vwd'))->render() !!}
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>


<script>
    function del(id){
        bootbox.confirm({
            message: "Bạn có chắc là muốn xóa Danh mục này không?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/app/delete') }}";
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

    function publish(table,field,id,status)
        {
            $("#publish"+id).html('<a href="javascript:;" class="btn btn-xs btn-default add-tooltip"><i class="fa fa-refresh fa-spin red"></i></a>');
            var url = "{{ url('admin/app/active') }}";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    table: table,
                    field: field,
                    id: id,
                    status: status
                },
                success: function(data){
                    $("#publish"+id).html(data.published);
                    //$("#publish"+id+" a").attr("data-original-title","Mowr");
                }

            });

        }



</script>
@endsection