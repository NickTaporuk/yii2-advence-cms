var gulp = require('gulp');
var concatCss = require('gulp-concat-css');

gulp.task('default', function () {
    //путь к папке
    return gulp.src('../frontend/web/css/*.css')
        .pipe(concatCss("../frontend/web/css/bundle.css"))
        .pipe(gulp.dest('out/'));
});