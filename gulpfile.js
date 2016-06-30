var less = require('gulp-less');
var concat = require('gulp-concat');
var gulp = require('gulp');

gulp.task('watch', function () {
    gulp.watch('./static/less/**/*', ['less']);
});

gulp.task('less', function () {
    return gulp
        .src('./assets/less/**/*.less')
        .pipe(less())
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./public/css/'));
});
