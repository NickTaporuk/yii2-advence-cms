var gulp = require('gulp'),
    concatCss       = require('gulp-concat-css'),
    minifyCSS       = require('gulp-minify-css'),
    notify          = require('gulp-notify'),
    autoprefixer    = require('gulp-autoprefixer'),
    renameCss       = require('gulp-rename');

gulp.task('default', function () {
    //путь к папке
    return gulp.src('/var/www/advanced/frontend/web/css/*.css')
        .pipe(concatCss("bundle.css"))
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 2 version','>1%','ie9'))
        .pipe(renameCss("bundle.min.css"))
        .pipe(gulp.dest('../frontend/web/css/minify/'))
        .pipe(notify('Done!'));
});

gulp.task('watch',function(){
    gulp.watch('/var/www/advanced/frontend/web/css/*.css',['default']);
});