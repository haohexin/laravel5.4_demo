@extends('admin.main')
@section('content')
<section class="content-header">
    <h1>
        <a class="btn bg-gray-active" href="{{url("/admin/admin/lists?nav=3-0")}}">管理员列表</a>
        @if(Auth::guard('admin')->user()->can('adminAdd'))
            <a class="btn btn-linkedin" href="{{url("/admin/admin/add?nav=3-1")}}">新增管理员</a>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url("/admin/index")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">管理员管理</li>
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
                            <th>管理员类型</th>
                            <th>用户名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="part1">
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->roles?$value->roles[0]->display_name:'暂无'}}</td>
                                <td>{{ $value->account }}</td>
                                <td>
                                    @if(Auth::guard('admin')->user()->can('adminEdit'))
                                        <a class="btn btn-bitbucket" href="{{url("/admin/admin/edit".'?nav=3-0&id='."$value->id")}}">修改</a>
                                    @endif
                                    @if(Auth::guard('admin')->user()->can('adminDelete'))
                                        <a class="btn btn-adn" href="{{url("/admin/admin/destroy".'?id='."$value->id")}}">删除</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {!! $data->appends(['nav'=>'1-0'])->links() !!}
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
@endsection