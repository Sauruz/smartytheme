/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var gulp = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var minify = require('gulp-clean-css');
var merge = require('merge-stream');
var rename = require('gulp-rename');
var flatten = require('gulp-flatten');
var del = require('del');
var runSequence = require('run-sequence');
var plumber = require('gulp-plumber');
var notify = require("gulp-notify");

var paths = {
    scripts: ['src/js/**/*.js'],
    sass: './src/scss/**/*.scss'
};

function handleError(err) {
    console.log(err.toString());
    this.emit('end');
}

var onError = function (err) {
    notify.onError({
        title: "Gulp",
        subtitle: "Failure!",
        message: "Error: <%= error.message %>",
        sound: "Pop"
    })(err);
    this.emit('end');
};

gulp.task('css', function () {
    var scssStream = gulp.src(['./src/scss/**/*.scss'])
            .pipe(plumber({errorHandler: onError}))
            .pipe(sass())
            .pipe(concat('scss-files.scss'));

    var cssStream = gulp.src([
//         'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
//         'bower_components/sweetalert/dist/sweetalert.css',
    ])
            .pipe(concat('css-files.css'));

    var mergedStream = merge(scssStream, cssStream)
            .pipe(concat('styles.css'))
            .pipe(minify())
            .pipe(gulp.dest('dist/css'))
            .pipe(notify({
                'title': 'SASS',
                'message': 'Sass compiled and compressed',
                'icon': 'gulp_img/sass.png',
                'sound': true
            }));
});

gulp.task('compress', function () {

    return gulp.src([
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/angular/angular.min.js',
        'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
//         'bower_components/datatables.net/js/jquery.dataTables.min.js',
//         'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
//         'bower_components/sweetalert/dist/sweetalert-dev.js',
        'src/js/main.js',
        'src/js/**/*'
    ])
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat('app.js'))
            .pipe(gulp.dest('dist/js')
                    .pipe(rename('uglify.js'))
                    .pipe(uglify())
                    .pipe(gulp.dest('dist/js'))
                    )
            .pipe(notify({
                'title': 'Javascript',
                'message': 'Javascript compiled and compressed',
                'icon': 'gulp_img/js.png',
                'sound': true
            }));
    ;
});

gulp.task('fonts', function () {
    return gulp.src([
        'bower_components/bootstrap/dist/fonts/*',
        'bower_components/font-awesome/fonts/*'
    ])
            .pipe(flatten())
            .pipe(gulp.dest('dist/fonts'))
            .pipe(notify({
                'title': 'Fonts',
                'message': 'Fonts copied',
                'icon': 'gulp_img/fonts.png',
                'sound': true
            }));
});

gulp.task('img', function () {
    return gulp.src([
        'src/img/*'
    ])
            .pipe(gulp.dest('dist/img'))
            .pipe(notify({
                'title': 'Images',
                'message': 'Images copied',
                'icon': 'gulp_img/images.png',
                'sound': true
            }));
});

gulp.task('watch', function () {
    gulp.watch(paths.scripts, ['compress']);
    gulp.watch(paths.sass, ['css']);
});

gulp.task('default', ['css', 'compress', 'fonts', 'img']);
