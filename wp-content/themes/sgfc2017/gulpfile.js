// Include gulp
var gulp = require('gulp'); 

// Include Plugins
var compass = require('gulp-compass');
var plumber = require('gulp-plumber');

// Compile Compass
gulp.task('compass', function() {
  gulp.src('media/styles/*.scss')
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
    .pipe(compass({
      css: 'media/styles',
      sass: 'media/styles'
    }))
    .pipe(gulp.dest('./'));
});

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch('media/styles/*.scss', ['compass']);
});

// Default Task
gulp.task('default', ['compass', 'watch']);