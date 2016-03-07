<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    <style type="text/css">
        .small-box {
            box-shadow: none;
        }
    </style>
    @yield('style')
</head>
<body>
<section class="wrapper" style="background: #ecf0f5;">
    @include('backend.layout.message.error')
    @include('backend.layout.message.success')
    <section class="content-header">
        <h1>
            {{$page_title or "Page Title"}}
            <small>{{$page_description or "Page Description"}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">General</li>
        </ol>
    </section>
    <section class="content">
        @yield('content')
    </section>
</section>
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $(".select2").select2();
        @if(Session::has('success'))
            $('#success-message').delay(5000).fadeOut();
        @endif

        @if(Session::has('errors'))
            $('#errors-message').delay(5000).fadeOut();
        @endif
    });
</script>
@yield('script')
</body>
</html>