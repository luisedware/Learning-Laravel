<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset("/assets/css/admin.css") }}" rel="stylesheet" type="text/css"/>
    @yield('style')
</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

    <!-- Header -->
    @include('admin.public.header')

    <!-- Sidebar -->
    @include('admin.public.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or "Page Description" }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> Level</a>
                </li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('admin.public.footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset ("/assets/js/admin.js") }}"></script>
<script src="{{ asset ("/bower_components/vue/dist/custom-filters.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/bower_components/vue/dist/custom-components.js") }}" type="text/javascript"></script>
@yield('script')
<script type="text/javascript">
    $(document).ajaxStart(function () {
        Pace.restart();
    });
</script>
</body>
</html>