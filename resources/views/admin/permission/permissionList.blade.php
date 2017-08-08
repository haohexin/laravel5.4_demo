@extends('admin.main')
@section('content')
    <section class="content-header">
        <h1>
            <a class="btn bg-gray-active" href="{{url("/admin/permission/permissionList?nav=4-0")}}">权限列表</a>
            @if(Auth::guard('admin')->user()->can('permissionAdd'))
                <a class="btn btn-linkedin" href="{{url("/admin/permission/permissionAdd?nav=19-0")}}">新增权限</a>
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
                            <th>权限</th>
                            <th>权限名称</th>
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
                                    @if(Auth::guard('admin')->user()->can('permissionEdit'))
                                        <a class="btn btn-bitbucket" href="{{url("/admin/permission/permissionEdit?nav=19-0&id="."$value->id")}}">修改</a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('permissionDelete'))
                                        <a class="btn btn-adn" href="{{url("/admin/permission/permissionDelete".'?id='."$value->id")}}">删除</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {!! $data->appends(['nav'=>'19-0'])->links() !!}
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