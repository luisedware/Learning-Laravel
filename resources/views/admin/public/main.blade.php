<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <link href="{{ asset("/assets/css/admin.css") }}" rel="stylesheet" type="text/css"/>
    @yield('style')
</head>
<body class="hold-transition skin-green fixed">
<div class="wrapper">
    @include('admin.public.header')
    @include('admin.public.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or "Page Description" }}</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> Level</a>
                </li>
                <li class="active">Here</li>
            </ol>
        </section>

        <section class="content">
            @include('admin.public.message.success')
            @include('admin.public.message.error')
            @yield('content')
        </section>
    </div>
    @include('admin.public.footer')
</div>
<script src="{{ asset ("/assets/js/admin.js") }}"></script>
<script src="{{ asset ("/bower_components/vue/dist/custom-filters.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/vue/dist/custom-components.js") }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        @if(Session::has('success'))
            $('#success-message').delay(5000).fadeOut();
        @endif

        @if(Session::has('errors'))
            $('#errors-message').delay(5000).fadeOut();
        @endif

         $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%'
        });
    });

    $(document).ajaxStart(function () {
        Pace.restart();
    });
</script>
@yield('script')
</body>
</html>