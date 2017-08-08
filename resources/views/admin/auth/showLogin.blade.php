<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>无锡和美妇产医院管理系统</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{url("/AdminLTE/bootstrap/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="{{url("/AdminLTE/dist/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
    <link rel="stylesheet" href="{{url("/AdminLTE/dist/css/ionicons.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url("/AdminLTE/dist/css/AdminLTE.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url("/AdminLTE/plugins/iCheck/square/blue.css")}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>无锡和美妇产医院</b></a>
    </div>
    <div class="login-logo">
        <a href="#">用户端管理系统</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('admin.alert')
        <form  method="POST" action="{{ url('admin/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group has-feedback">
                <input type="text" name="account" class="form-control" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
    <div class="login-bottom">

    </div>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{url("/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url("/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- iCheck -->
<script src="{{url("/AdminLTE/plugins/iCheck/icheck.min.js")}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
