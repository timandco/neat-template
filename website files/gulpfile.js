/* ===== Setting the variables ===== */

var         gulp = require('gulp'),
            sass = require('gulp-sass'),
     browserSync = require('browser-sync').create();


/* ===== Sass Compilation ===== */

gulp.task('sass', function () {
  gulp.src('./sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
});
 
/* ===== BrowserSync Live Reload Server ===== */

gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: './'
        }
    });
});


/* ===== Making them work together ===== */

gulp.task('default', ['sass', 'browser-sync'], function () {
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch('./*.html').on('change', browserSync.reload);
    gulp.watch('./js/**/*.js').on('change', browserSync.reload);
});