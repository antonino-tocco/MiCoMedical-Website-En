/**
 * Created by entony on 29/02/16.
 */
var gulp = require('gulp');
var minify = require('gulp-minify');
var uglify = require('gulp-uglify');
var cssnano = require('gulp-cssnano');
var path = require('path');
var rmdir = require('rimraf');
var mkdirp = require('mkdirp');
var connect = require('gulp-connect');

gulp.task('deploy', function () {
    var cssDestinationBasePath = path.join(process.cwd() + '/dist/css/');
    var jsDestinationBasePath = path.join(process.cwd() + '/dist/js/');
    var appDestinationBasePath = path.join(process.cwd() + '/dist/app/');
    console.log('MINIFY CSS TO FOLDER -> ' + cssDestinationBasePath);
    rmdir(cssDestinationBasePath, function(error) {
        mkdirp(cssDestinationBasePath, function (error) {
            try {
                gulp.src(path.join(process.cwd(), 'css/*.css'))
                    .pipe(cssnano())
                    .pipe(gulp.dest(cssDestinationBasePath));
            } catch (ex) {
                console.log(ex);
            }
        });
    });
    console.log('MINIFY JS TO FOLDER -> ' + jsDestinationBasePath);
    rmdir(jsDestinationBasePath, function (error) {
        mkdirp(jsDestinationBasePath, function (error) {
            try {
                gulp.src(path.join(process.cwd(), 'js/*.js'))
                    .pipe(uglify({
                        mangle: false
                    })).pipe(gulp.dest(jsDestinationBasePath));
            } catch (ex) {
                console.log(ex);
            }
        });
    });
    console.log('MINIFY APP SCRIPT TO FOLDER -> ' + appDestinationBasePath);
    rmdir(appDestinationBasePath, function (error) {
        mkdirp(appDestinationBasePath, function (error) {
            try {
                gulp.src(path.join(process.cwd(), 'app/**/*.js'))
                    .pipe(uglify({

                        mangle: false
                    })).pipe(gulp.dest(appDestinationBasePath));
            } catch (ex) {
                console.log(ex);
            }
        });
    });
});

gulp.task('default',['deploy']);