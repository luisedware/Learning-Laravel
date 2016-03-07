<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ $page_title or "AdminLTE Dashboard" }}</title>
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    @yield('style')
</head>
<body class="skin-green sidebar-mini">
<div class="wrapper">
    @include('backend.layout.header')
    @include('backend.layout.sidebar')
    <div class="content-wrapper">
        <div class="nav-tabs-custom" style="margin-bottom: 0;">
            <ul id="navTabs" class="nav nav-tabs">
                <li class="pull-right">
                    <a href="#" class="text-muted">
                        <i class="fa fa-gear"></i>
                    </a>
                </li>
            </ul>
            <div id="tabContents" class="tab-content">
            </div>
        </div>
    </div>
    @include('backend.layout.footer')
</div>
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/assets/js/bundle.js") }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ajaxStart(function () {
        Pace.restart();
    });

    function closeTabs(tanPane) {
        var navTabs = document.getElementById('navTabs');
        var li = document.getElementById('li' + tanPane.id);
        navTabs.removeChild(li);
        document.getElementById('tabContents').removeChild(tanPane);

        if (navTabs.childNodes.length <= 3) {
            console.log(navTabs.childNodes.length);
            document.getElementById('tabContents').style.display = 'none';
        }
    }

    $(function () {
        $('#tabContents').hide();

        $('.sidebar-menu li a').click(function () {

            var url = $(this).attr('data-url');

            if (url) {
                var name = $(this).find('span').html().trim();
                var navTabs = $('#navTabs');
                var tabContents = $('#tabContents');
                tabContents.show();

                var result = navTabs.find('li a[href="#' + name + '"]');

                if (result.length > 0) {
                    navTabs.find('li').removeClass('active');
                    result.offsetParent('li').addClass('active');
                    tabContents.find('div').removeClass('active');
                    tabContents.find('div#' + name).addClass('active');
                    return 0;
                }

                navTabs.find('li').removeClass('active');
                navTabs.append('<li id="li' + name + '" class="active"><a href="#' + name + '" data-toggle="tab">' + name + ' <i class="close-tabs fa fa-times" onclick="closeTabs(' + name + ')"></i></a></li>');

                var tabPane = '<div class="tab-pane active" id="' + name + '">';
                tabPane += '<div class="embed-responsive embed-responsive-16by9">';
                tabPane += '<iframe class="embed-responsive-item" src="' + url + '" frameborder="0"></iframe>';
                tabPane += '</div>';
                tabPane += '</div>';
                tabContents.find('div').removeClass('active');
                tabContents.append(tabPane);
            } else {
                return 0;
            }
        });
    });
</script>
@yield('script')
</body>
</html>