@extends('admin.main') @section('content')
    <section class="content-header">
        <h1>
            <a class="btn bg-gray-active" href="{{url("/admin/category/lists?nav=2-0")}}">类型列表</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url("/admin/index")}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">类型管理</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('admin.alert')
        <div class="row">
            <!-- right column -->
            <div class="col-xs-12">
                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">修改类型</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/category/editPost') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label">选择级别</label>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control input-sm" disabled>
                                        <option value="1" @if($data->type == 1) selected @endif>一级</option>
                                        <option value="2" @if($data->type == 2) selected @endif>二级</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型名称</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn bg-yellow-active pull-right">提交</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
