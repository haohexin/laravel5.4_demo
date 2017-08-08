@extends('admin.main')
@section('content')
    <section class="content-header">
        <h1>
            <a class="btn bg-gray-active" href="{{url("/admin/nav/lists?nav=2-0")}}">导航列表</a>
            @if(Auth::guard('admin')->user()->can('navAdd'))
                <a  class="btn btn-linkedin" href="{{url("/admin/nav/add?nav=2-0")}}">新增导航</a>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url("/admin/index")}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">导航管理</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('admin.alert')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <label>
                        <select class="form-control" onchange="change(this);">
                            <option value="0">请选择</option>
                            @foreach($data as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label id="part2">

                    </label>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>类型名称</th>
                                <th>URL</th>
                                <th>权限</th>
                                <th>图标</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="part1">
                            @foreach ($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name?$value->name:'暂无'}}</td>
                                    <td>{{$value->url?$value->url:'暂无'}}</td>
                                    <td>{{$value->permission?$value->permission:'暂无'}}</td>
                                    <td>{{$value->icon?$value->icon:'暂无'}}</td>
                                    <td>{{$value->rank?$value->rank:'暂无'}}</td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->can('navEdit'))
                                            <a class="btn bg-yellow-active" href="{{url("/admin/nav/edit?nav=3-0&id="."$value->id")}}">修改</a>
                                        @endif
                                        @if(Auth::guard('admin')->user()->can('navDelete'))
                                            <a class="btn btn-adn" href="{{url("/admin/nav/destroy".'?id='."$value->id")}}">删除</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{--{!! $data->links() !!}--}}
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


    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        function change(a) {
            var id = a.value;
            $.ajax({ type: "get", url: "<?php echo url('/admin/nav/findLists');?>",data:{
                id: id
            }, cache: false,async: true,dataType: 'json',
                success: function (data) {
                    var aa ="";
                    $("#part1").empty();
                    $("#part2").empty();
                    if (id == 0){
                        $.each(data,function(index,item){
                            $("#part1").append(
                                "<tr><td>"+item.id+"</td>" +
                                "<td>"+item.code+"</td>" +
                                "<td>"+item.name+"</td>" +
                                "<td>"+item.url+"</td>" +
                                "<td>"+item.permission+"</td>" +
                                "<td>"+item.icon+"</td>" +
                                "<td>"+item.rank+"</td>" +
                                "<td><a class='btn btn-bitbucket' href='{{url('/admin/nav/edit?nav=2-0&id=')}}"+item.id+"'>修改</a> <a class='btn btn-adn' href='{{url('/admin/nav/destroy?nav=2-0&id=')}}"+item.id+"'>删除</a></td></tr>"
                            );
                        });
                    }else {
                        $.each(data,function(index,item){
                            $("#part1").append(
                                "<tr><td>"+item.id+"</td>" +
                                "<td>"+item.name+"</td>" +
                                "<td>"+item.url+"</td>" +
                                "<td>"+item.permission+"</td>" +
                                "<td>"+item.icon+"</td>" +
                                "<td>"+item.rank+"</td>" +
                                "<td><a class='btn btn-bitbucket' href='{{url('/admin/nav/edit?nav=2-0&id=')}}"+item.id+"'>修改</a> <a class='btn btn-adn' href='{{url('/admin/nav/destroy?nav=2-0&id=')}}"+item.id+"'>删除</a></td></tr>"
                            );
                        });
                        $.each(data,function(index,item){
                            aa+= "<option value='"+item.id+"'>"+item.name+"</option>";
                        });
                        $("#part2").append(
//                            "<select class='form-control' onchange='change2(this);'><option value='0'>请选择</option>"+aa+"</select>"
                            "<select class='form-control'><option value='0'>请选择</option>"+aa+"</select>"
                        );
                    }
                }
            });
        }
        function change2(a) {
            var id = a.value;
            $.ajax({ type: "get", url: "<?php echo url('/admin/address/find_lists');?>",data:{
                id: id,
                province: id
            }, cache: false,async: true,dataType: 'json',
                success: function (data) {
                    if (id == 0){
                        $("#part1").empty();
                    }else{
                        $("#part1").empty();
                        $.each(data,function(index,item){
                            $("#part1").append(
                                "<tr><td>"+item.id+"</td><td>"+item.code+"</td><td>"+item.name+"</td><td><a class='btn btn-bitbucket' href='{{url('/admin/address/edit?id=')}}"+item.id+"'>修改</a> <a class='btn btn-adn' href='{{url('/admin/address/destroy?id=')}}"+item.id+"'>删除</a></td></tr>"
                            );
                        });
                    }
                }
            });
        }
    </script>

@endsection