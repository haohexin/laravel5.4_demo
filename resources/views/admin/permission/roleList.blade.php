@extends('admin.main')
@section('content')
    <section class="content-header">
        <h1>
            <a class="btn bg-gray-active" href="{{url("/admin/permission/roleList?nav=4-2")}}">角色列表</a>
            @if(Auth::guard('admin')->user()->can('roleAdd'))
                <a class="btn btn-linkedin" href="{{url("/admin/permission/roleAdd?nav=19-1")}}">新增角色</a>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url("/admin/index")}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">权限管理</li>
        </ol>
    </section>
<!-- Main content -->
<section class="content">
    @include('admin.alert')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>角色</th>
                            <th>角色名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="part1">
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->display_name }}</td>
                                <td>
                                    @if(Auth::guard('admin')->user()->can('roleEdit'))
                                        <a class="btn btn-bitbucket" href="{{url("/admin/permission/roleEdit?nav=19-1&id="."$value->id")
                                        }}">修改</a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('roleEditPermission'))
                                            <a class="btn btn-facebook" href="{{url("/admin/permission/rolePermissionEdit?nav=19-1&id="."$value->id")}}">修改权限</a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('roleDelete'))
                                            <a class="btn btn-adn" href="{{url("/admin/permission/roleDelete".'?id='."$value->id")}}">删除</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {!! $data->appends(['nav'=>'19-1'])->links() !!}
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- DataTables -->
<script src="{{url("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{url("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
@endsection