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
var replace = require('gulp-replace');

//images
var path = require('path');
var image = require('gulp-image');
var changed = require('gulp-changed');

var paths = {
    src: {
        scripts: ['src/js/**/*.js'],
        sass: './src/scss/**/*.scss',
        img: 'src/img/**/*.{png,jpg,jpeg,gif,svg}'
    },
    dest: {
        img: 'dist/img'
    }
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

/**
 * ######################################################################
 * SASS
 * ######################################################################
 */
gulp.task('css', function () {
    var scssStream = gulp.src(['./src/scss/**/*.scss'])
            .pipe(plumber({errorHandler: onError}))
            .pipe(sass())
            .pipe(concat('scss-files.scss'));

    var cssStream = gulp.src([

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

/**
 * ######################################################################
 * JAVASCRIPT
 * ######################################################################
 */

gulp.task('js', function () {

    return gulp.src([
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
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

/**
 * ######################################################################
 * FONTS
 * ######################################################################
 */

gulp.task('fonts', function () {
    return gulp.src([
        'bower_components/bootstrap/dist/fonts/*',
        'bower_components/font-awesome/fonts/*',
        'src/fonts/*'
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

/**
 * ######################################################################
 * IMAGES
 * ######################################################################
 */

gulp.task('img', function () {
    return gulp.src(paths.src.img)

        //Changed is only processing changed files
        .pipe(changed(paths.dest.img))

        //Image is compressing the image size
        .pipe(image())
        .pipe(gulp.dest(paths.dest.img))

        .pipe(notify({
            'title': 'Images',
            'message': 'Image copied',
            'icon': 'gulp_img/images.png',
            'sound': true
        }));
});

/**
 * ######################################################################
 * FAVICONS
 * ######################################################################
 */

var realFavicon = require('gulp-real-favicon');
var fs = require('fs');

// File where the favicon markups are stored
var FAVICON_DATA_FILE = 'faviconData.json';
var packageJson = JSON.parse(fs.readFileSync('package.json'));

// Generate the icons. This task takes a few seconds to complete.
// You should run it at least once to create the icons. Then,
// you should run it whenever RealFaviconGenerator updates its
// package (see the check-for-favicon-update task below).
gulp.task('generate-favicon', function (done) {
    realFavicon.generateFavicon({
        masterPicture: 'src/favicon-original-260x260.png',
        dest: 'dist/img/favicons',
        iconsPath: '/',
        design: {
            ios: {
                pictureAspect: 'noChange',
                assets: {
                    ios6AndPriorIcons: false,
                    ios7AndLaterIcons: false,
                    precomposedIcons: false,
                    declareOnlyDefaultIcon: true
                }
            },
            desktopBrowser: {},
            windows: {
                pictureAspect: 'noChange',
                backgroundColor: '#da532c',
                onConflict: 'override',
                assets: {
                    windows80Ie10Tile: false,
                    windows10Ie11EdgeTiles: {
                        small: false,
                        medium: true,
                        big: false,
                        rectangle: false
                    }
                }
            },
            androidChrome: {
                pictureAspect: 'noChange',
                themeColor: '#ffffff',
                manifest: {
                    name: packageJson['name'],
                    display: 'standalone',
                    orientation: 'notSet',
                    onConflict: 'override',
                    declared: true
                },
                assets: {
                    legacyIcon: false,
                    lowResolutionIcons: false
                }
            },
            safariPinnedTab: {
                pictureAspect: 'silhouette',
                themeColor: '#5bbad5'
            }
        },
        settings: {
            scalingAlgorithm: 'Mitchell',
            errorOnImageTooSmall: false
        },
        markupFile: FAVICON_DATA_FILE
    }, function () {
        done();
    });
});

/**
 * ######################################################################
 * ADD VERSION NUMBERS TO header and footer
 * ######################################################################
 */
var version = Math.round(+new Date()/1000);
gulp.task('addVersionNumberHeader', function(){
    return gulp.src(['templates/parts/header.tpl'])
        .pipe(replace(/styles.css\?v=[\s\S]*?\"/, 'styles.css?v=' + version + '"'))
        .pipe(gulp.dest('templates/parts/'));
});
gulp.task('addVersionNumberFooter', function(){
    return gulp
        .src(['templates/parts/footer.tpl'])
        .pipe(replace(/app.js\?v=[\s\S]*?\"/, 'app.js?v=' + version + '"'))
        .pipe(gulp.dest('templates/parts/'));
});

/**
 * ######################################################################
 * WATCH
 * ######################################################################
 */

gulp.task('watch', function () {
    gulp.watch(paths.src.scripts, ['js', 'addVersionNumberFooter']);
    gulp.watch(paths.src.sass, ['css', 'addVersionNumberHeader']);

    //Watch images and delete images from dist if image is deleted from src
    var watcher = gulp.watch(paths.src.img, ['img']);
    watcher.on('change', function (event) {
        if (event.type === 'deleted') {
            var fileNameBase = path.basename(event.path, '.ts');
            del([paths.dest.img + '/' + fileNameBase])
                .then(function (paths) {
                    console.log("deleted files: " + paths.join('\n'));
                });
        }
    });
});

gulp.task('default', ['css', 'js', 'fonts', 'img', 'generate-favicon', 'addVersionNumberHeader', 'addVersionNumberFooter']);
