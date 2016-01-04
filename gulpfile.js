var gulp = require('gulp');
var elixir = require('laravel-elixir');

gulp.task("copyfiles", function () {
    gulp.src("vendor/bower_dl/jquery/dist/jquery.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/AdminLTE/dist/js/app.min.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/font-awesome/less/**")
        .pipe(gulp.dest("resources/assets/less/fontawesome"));
    gulp.src("vendor/bower_dl/font-awesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts/"));

    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap/"));

    gulp.src("vendor/bower_dl/AdminLTE/build/**")
        .pipe(gulp.dest("resources/assets/less/adminlte/"));
    gulp.src("vendor/bower_dl/AdminLTE/dist/css/skins/skin-green.min.css")
        .pipe(gulp.dest('resources/assets/css/'));
    gulp.src("vendor/bower_dl/AdminLTE/dist/img/**")
        .pipe(gulp.dest("public/assets/img/"));

});

elixir(function (mix) {
    //合并js
    mix.scripts(
        [
            'js/jquery.min.js',
            'js/bootstrap.min.js',
            'js/app.min.js'
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
        ['adminlte.css', 'bootstrap.css','fontawesome.css','skin-green.min.css'],
        'public/assets/css/admin.css',
        'resources/assets/css/'
    );

    //启动测试单元
    mix.phpUnit();
});
