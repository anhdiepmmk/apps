@extends('admin.master')
@section('content')

    <div class="page-header">

	    <h1>Quản lý Danh Mục</h1>
	    <div class="pull-right" id="top-righ-icon">
            <a class="btn btn-primary" title="" data-toggle="tooltip" href="{{ url('admin/category/create') }}" data-placement="bottom" data-original-title="Thêm mới"><i class="fa fa-plus"></i></a>
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
            <span class="panel-title"><i class="menu-icon fa fa-sitemap"></i> Quản lý Danh Mục</span>
        </div>
        <div>
            <form action="{{ URL::to('/admin/category/deleteall') }}" id="adminForm" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token()  }}" />
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover admin-table">
                <thead>
                    <tr>
                        <th style="width:1ex"><input type="checkbox" name="sa" id="sa" onclick="checkbox('sa', 'ar_id[]', 'adminForm')"></th>
                        <th>Tên Danh Mục</th>
                        <th>Link Google</th>
                        <th style="width:100px" class="text-center hidden-xs col-md-1">Sắp xếp {!! icon_ordering() !!}</th>
                        <th class="text-center" style="width:15ex">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mainCategories as $row)
                        <tr>
                            <td class="valign-middle"><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                            <td class="valign-middle text-semibold">{{ $row->name }}</td>
                            <td class="valign-middle text-semibold">{{ $row->link }}</td>
                            <td align="center" class="valign-middle hidden-xs">
                                <input type="text" class="order form-control text-semibold" name="order[]" value="{{ $row->ordering }}">
                                <input type="hidden" name="id[]" value="{{ $row->id }}">
                            </td>
                            <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                <?php
                                    $editurl = url('admin/category').'/'.$row->id.'/edit';
                                ?>
                                {!! icon_edit($editurl) !!}
                                {!! icon_del($row->id) !!}
                            </td>
                        </tr>
                        <?php $categories = \App\Category::getChildCategories($row->id) ?>
                        @foreach($categories as $row)
                            <tr>
                                <td class="valign-middle"><input type="checkbox" name="ar_id[]" value="{{ $row->id }}"></td>
                                <td class="valign-middle"><i class="fa fa-angle-right"></i> {{ $row->name }}</td>
                                <td class="valign-middle text-xs">{{ $row->link }}</td>
                                <td align="center" class="valign-middle hidden-xs">
                                    <input type="text" class="order form-control" name="order[]" value="{{ $row->ordering }}">
                                    <input type="hidden" name="id[]" value="{{ $row->id }}">
                                </td>
                                <td id="action_colum" class="text-center valign-middle" style="width:15ex">
                                    <?php
                                        $editurl = url('admin/category').'/'.$row->id.'/edit';
                                    ?>
                                    {!! icon_edit($editurl) !!}
                                    {!! icon_del($row->id) !!}
                                </td>
                            </tr>
                        @endforeach
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
                    var url = "{{ url('admin/category/delete') }}";
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
    function save_order(){
        var fields = $("#adminForm :input").serializeArray();
        var order_ids = $('input[name="id[]"]').map(function(){
            return this.value;
        }).get();
        var order_positions = $('input[name="order[]"]').map(function(){
            return this.value;
        }).get();
        var url = "{{ url('admin/category/reorder') }}";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: "{{ csrf_token() }}",
                order_ids: order_ids,
                order_positions: order_positions
            }
        }).done(function(){
            location.reload();
        });
    }


</script>
@endsection