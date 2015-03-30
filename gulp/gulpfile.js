var gulp = require('gulp');
var concatCss = require('gulp-concat-css'),
    minifyCSS = require('gulp-minify-css'),
    renameCss = require('gulp-rename');

gulp.task('default', function () {
    //путь к папке
    return gulp.src('/var/www/advanced/frontend/web/css/*.css')
        .pipe(concatCss("bundle.css"))
        .pipe(minifyCSS())
        .pipe(renameCss("bundle.min.css"))
        .pipe(gulp.dest('../frontend/web/css/minify/'));
});

gulp.task('watch',function(){
    gulp.watch('/var/www/advanced/frontend/web/css/*.css',['default']);
});