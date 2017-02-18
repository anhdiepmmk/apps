@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Users Management</h1>
	    <div class="pull-right" id="top-righ-icon">
            <a class="btn btn-primary" title="" data-toggle="tooltip" href="{{ url('admin/user/create') }}" data-placement="bottom" data-original-title="Add"><i class="fa fa-plus"></i></a>
            <a class="btn btn-danger" onclick="submitAdminForm()" href="javascript:;" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i>&nbsp;Users List</span>
        </div>
        <div class="panel-body">

            <div>
                <form action="" method="GET">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search by name, email or ID..." name="search">
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
                <form action="{{ URL::to('/admin/user/deleteall') }}" id="adminForm" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                    <thead>
                        <tr>
                            <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Last Login</th>
<!--                            <th>Category</th>-->
                            <th class="text-center" style="width:15ex">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                            <tr>
                                <td class="valign-middle"><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                                <td class="valign-middle"><a href="<?=url('admin/user').'/'.$row->id.'/edit'?>">{{ $row->id }}</a></td>
                                <td class="valign-middle"><a href="<?=url('admin/user').'/'.$row->id.'/edit'?>">{{ $row->email }}</a></td>
                                <td class="valign-middle">{{ $row->name }}</td>
                                <td class="valign-middle">{{ $row->location }}</td>
                                <td class="valign-middle">{{ empty($row->last_login) ? '-' : date('Y/m/d H:i:s', $row->last_login) }}</td>
                                <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                    <?php
                                        $editurl = url('admin/user').'/'.$row->id.'/edit';
                                    ?>
                                    {!! icon_edit($editurl) !!}
                                    {!! icon_del($row->id) !!}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="table-footer clearfix" style="border: 0px; margin-top: 0px">
                    <div class="DT-label">Total {{ $users->total() }} users</div>
                    <div class="DT-pagination">
                        {!! $users->render() !!}
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>


<script>
    function del(id){
        bootbox.confirm({
            message: "Do you want to delete this user?",
            callback: function(result) {
                if(result == true){
                    var url = "{{ url('admin/user/delete') }}";
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