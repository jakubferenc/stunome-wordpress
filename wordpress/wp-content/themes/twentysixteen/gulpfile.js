  'use strict';

// Load plugins
const gulp = require('gulp'),
      plugins = require('gulp-load-plugins')({ camelize: true }),
      pngquant = require('imagemin-pngquant'),
      jpegtran = require('imagemin-jpegtran'),
      gifsicle = require('imagemin-gifsicle');

// settings
const autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

// Copy fonts if Changed
gulp.task('fonts', function() {
  return gulp.src('src/fonts/**/*')
    .pipe(plugins.changed('dist/fonts'))
    .pipe(gulp.dest('dist/fonts'));
});


// Image Optimization tasks

// -----------------------------------------------------------------------------
// Minify SVGs and compress images
//
// It's good to maintain high-quality, uncompressed assets in your codebase.
// However, it's not always appropriate to serve such high-bandwidth assets to
// users, in order to reduce mobile data plan usage.
// -----------------------------------------------------------------------------
gulp.task('svg-copy', function() {
  return gulp.src('src/img/**/*.svg')
    .pipe(plugins.changed('dist/img'))
    .pipe(gulp.dest('dist/img'));
});


gulp.task('image-minify', function() {
  return gulp.src(['src/img/**/*.jpg', 'src/img/**/*.png'])
    .pipe(plugins.changed('dist/img'))
    .pipe(plugins.imagemin({
      progressive: false,
      svgoPlugins: [{removeViewBox: false}]
    }))
    .pipe(gulp.dest('dist/img'));
});

// -----------------------------------------------------------------------------
// Convert images to the WebP format
//
// It's good to maintain high-quality, uncompressed assets in your codebase.
// However, it's not always appropriate to serve such high-bandwidth assets to
// users, in order to reduce mobile data plan usage.
// -----------------------------------------------------------------------------
gulp.task('image-webp', function() {
    return gulp.src(['src/img/*.jpg', 'src/img/*.png', 'src/img/*.jpeg', 'src/img/*.gif', 'src/img/*.svg'])
        .pipe(plugins.changed('dist/img'))
        .pipe(plugins.webp())
        .pipe(gulp.dest('dist/img'))
});

// Lint Task
gulp.task('lint', function() {
    return gulp.src('src/js/*.js')
        .pipe(plugins.jshint())
        .pipe(plugins.jshint.reporter('default'));
});



// Less Task
gulp.task('less', function () {

  return gulp.src([
    'src/css/lib/featherlight.min.css',
    'src/css/lib/slick.css',
    'http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
    'src/css/lib/bootstrap.min.css', 
    'src/css/main.less'
  ])
  .pipe(plugins.less().on('error', function (err) {
    console.log(err);
    plugins.gutil.log(err);
  }))
  .pipe(plugins.autoprefixer(autoprefixerOptions))
  .pipe(plugins.concat('main.min.css'))
  /*.pipe(plugins.uncss({
      html: ['http://localhost:3000']
  }))*/  
  .pipe(plugins.cssmin().on('error', function(err) {
    console.log(err);
    plugins.gutil.log(err);
  }))
  .pipe(gulp.dest('dist/css/'));

});

// plugins.Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src([
        'src/js/lib/slick.min.js',
        'src/js/plugins.js', 
        'src/js/main.js'])
        .pipe(plugins.changed('dist/js'))
        .pipe(plugins.concat('all.js'))
        .pipe(plugins.rename('all.min.js'))
        .pipe(plugins.uglify())
        .pipe(gulp.dest('dist/js'));
});


// Watch Files For Changes
gulp.task('watch', function () {
  gulp.watch('src/css/*.less', ['less']);
  gulp.watch('src/js/*.js', ['lint', 'scripts']);
});



// Default Task
gulp.task('default', ['fonts', 'svg-copy', 'image-minify', 'lint', 'less', 'scripts', 'watch']);
