<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Lockscreen</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset("/assets/css/admin.css") }}" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition lockscreen">
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <b>TianMao</b>CMF
        @include('admin.public.message.error')
        @include('admin.public.message.success')
    </div>
    <div class="lockscreen-name">John Doe</div>
    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="/bower_components/admin-lte/dist/img/user1-128x128.jpg" alt="User Image">
        </div>
        <form class="lockscreen-credentials" method="post" action="{{URL::to('password/email')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="hello@world.com" name="email">

                <div class="input-group-btn">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="help-block text-center">
        请输入找回密码的邮箱地址
    </div>
    <div class="text-center">
        <a href="{{URL::to('auth/login')}}">用户登录</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; 2014-2016 <b><a href="/" class="text-black">TianMaoCMF</a></b><br>
        All rights reserved
    </div>
</div>
<script src="{{ asset ("/assets/js/admin.js") }}"></script>

</body>
</html>
