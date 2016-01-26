var gulp = require('gulp');
var elixir = require('laravel-elixir');

gulp.task("copyfiles", function () {
    //jQuery
    gulp.src("vendor/bower_dl/jquery/dist/jquery.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    //Bootstrap
    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap/"));

    //Slimscroll
    gulp.src("vendor/bower_dl/AdminLTE/plugins/slimScroll/jquery.slimscroll.js")
        .pipe(gulp.dest("resources/assets/js/"));

    //Pace
    gulp.src("vendor/bower_dl/AdminLTE/plugins/pace/pace.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src('vendor/bower_dl/AdminLTE/plugins/pace/pace.css')
        .pipe(gulp.dest("resources/assets/css/"));

    //Fontawesome
    gulp.src("vendor/bower_dl/font-awesome/less/**")
        .pipe(gulp.dest("resources/assets/less/fontawesome"));
    gulp.src("vendor/bower_dl/font-awesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts/"));

    //AdminLTE
    gulp.src("vendor/bower_dl/AdminLTE/build/**")
        .pipe(gulp.dest("resources/assets/less/adminlte/"));
    gulp.src("vendor/bower_dl/AdminLTE/dist/css/skins/skin-green.min.css")
        .pipe(gulp.dest('resources/assets/css/'));
    gulp.src("vendor/bower_dl/AdminLTE/dist/img/**")
        .pipe(gulp.dest("public/assets/img/"));
    gulp.src("vendor/bower_dl/AdminLTE/dist/js/app.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    //Select2
    gulp.src("vendor/bower_dl/AdminLTE/plugins/select2/select2.css")
        .pipe(gulp.dest("resources/assets/css/"));
    gulp.src("vendor/bower_dl/AdminLTE/plugins/select2/select2.js")
        .pipe(gulp.dest("rresources/assets/js/"));
    gulp.src("vendor/bower_dl/AdminLTE/plugins/select2/select2.full.js")
        .pipe(gulp.dest("resources/assets/js/"));

    //Daterangepicker
    gulp.src('vendor/bower_dl/AdminLTE/plugins/daterangepicker/daterangepicker.js')
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src('vendor/bower_dl/AdminLTE/plugins/daterangepicker/moment.js')
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src('vendor/bower_dl/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css')
        .pipe(gulp.dest("resources/assets/css/"));

    //vue vue-resource
    gulp.src('vendor/bower_dl/vue/dist/vue.js')
        .pipe(gulp.dest("resources/assets/js/"));;
    gulp.src('vendor/bower_dl/vue-resource/dist/vue-resource.js')
        .pipe(gulp.dest("resources/assets/js/"));
});

elixir(function (mix) {
    //合并js
    mix.scripts(
        [
            'js/jquery.min.js',
            'js/jquery.slimscroll.js',
            'js/bootstrap.min.js',
            'js/app.min.js',
            'js/pace.js',
            'js/moment.js',
            'js/daterangepicker.js',
            'js/select2.full.js',
            'js/vue.js',
            'js/vue-resource.js'
        ],
        'public/assets/js/admin.js',
        'resources/assets/'
    );

    //编译less
    mix.less('adminlte.less', 'resources/assets/css/adminlte.css');
    mix.less('bootstrap.less', 'resources/assets/css/bootstrap.css');
    mix.less('fontawesome.less','resources/assets/css/fontawesome.css');

    //合并css
    mix.styles(
        [
            'select2.css',
            'daterangepicker-bs3.css',
            'pace.css',
            'bootstrap.css',
            'adminlte.css',
            'fontawesome.css',
            'skin-green.min.css'
        ],
        'public/assets/css/admin.css',
        'resources/assets/css/'
    );

    //启动测试单元
    mix.phpUnit();
});
