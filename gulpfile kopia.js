// Load all the modules from package.json
var gulp = require( 'gulp' ),
    browserSync = require('browser-sync').create(),
    plumber = require( 'gulp-plumber' ),
    autoprefixer = require('gulp-autoprefixer'),
    watch = require( 'gulp-watch' ),
    jshint = require( 'gulp-jshint' ),
    stylish = require( 'jshint-stylish' ),
    uglify = require( 'gulp-uglify' ),
    notify = require( 'gulp-notify' ),
    sass = require( 'gulp-sass' ),
    imagemin = require('gulp-imagemin'),
    cleanCSS = require('gulp-clean-css'),
    concatCss = require('gulp-concat-css'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps'),
    merge = require('merge-stream'),
    stripCssComments = require('gulp-strip-css-comments');

// Default error handler
var onError = function( err ) {
    console.log( 'An error occured:', err.message );
    this.emit('end');
}

// Enter URL of your local server here
var URL = 'http://localhost:3000§';
var includeBootstrapJS = false;
if(includeBootstrapJS == true) {
    var pluginsJS = './assets/js/plugins/*.js';
}else{
    var pluginsJS =  ['!./assets/js/plugins/bootstrap.bundle.js', './assets/js/plugins/*.js'];
}


// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
var options = {};
options.sass = {
    errLogToConsole: true,
    sourceMap: 'sass',
    sourceComments: 'map',
    outputStyle: 'nested',
    precision: 10,
    includePaths: []
};

// Browsersync task
gulp.task('browser-sync', function() {
  var files = [
        '**/*.php',
        '**/**/*.php',
        '*.php',
        'assets/img/**/*.{png,jpg,gif}',
    ];
  browserSync.init(files, {
    // Proxy address
    proxy: URL,
  });
});

gulp.task('sass', function() {

    return gulp.src('./assets/sass/screen.scss')

        .pipe(sourcemaps.init())
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass(options.sass))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4' ))
        .pipe(cleanCSS())
        .pipe(stripCssComments({ preserve: false }))
        .pipe(sourcemaps.write())
        .pipe(concat('screen.css'))
        .pipe(gulp.dest('./assets/css/'))
        .pipe(browserSync.stream());
});

// Clean CSS
gulp.task('minify-css', () => {
  return gulp.src('./assets/css/*.css')
    .pipe(cleanCSS({debug: true}, function(details) {
      console.log(details.name + ': ' + details.stats.originalSize);
      console.log(details.name + ': ' + details.stats.minifiedSize);
    }))
  .pipe(gulp.dest('./assets/css/'));
});

gulp.task('libraryScripts', function() {
    return gulp.src(pluginsJS)
        .pipe(uglify())
        .pipe(concat('lib.js'))
        .pipe(gulp.dest('./assets/js'));
});

gulp.task('themeScripts', function() {
    themeScript = gulp.src('./assets/js/app.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(sourcemaps.write());

    libScript = gulp.src('./assets/js/lib.js');

    return merge(themeScript, libScript)
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('./assets/js'))
        .pipe(browserSync.stream());
});

// Minify Custom JavaScript files
gulp.task('clean-js', function() {
    themeScript = gulp.src('./assets/js/app.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(uglify());

    libScript = gulp.src('./assets/js/lib.js');

    return merge(themeScript, libScript)
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('./assets/js'))
        .pipe(browserSync.stream());
});

// Optimize Images
gulp.task('images', function() {
    return gulp.src('./assets/img/*')
        .pipe(imagemin({ progressive: true, svgoPlugins: [{removeViewBox: false}]}))
        .pipe(gulp.dest('./assets/img'))
});

// Watch task
gulp.task( 'watch', ['browser-sync'], function() {
    gulp.watch( './assets/js/app.js', [ 'themeScripts' ]);
    gulp.watch( './assets/sass/components/**/*.scss', ['sass']);
});

// Clean the project
gulp.task( 'clean', ['minify-css', 'clean-js', 'images']);

// Default task
gulp.task( 'default', ['themeScripts', 'sass', 'images']);
