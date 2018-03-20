/* eslint no-console: "warn" */
/* eslint no-undef: "warn" */
/* eslint no-redeclare: "warn" */

'use strict';

var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var ngAnnotate = require('gulp-ng-annotate');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var gulpNgConfig = require('gulp-ng-config');
var iife = require('gulp-iife');
var gulpif = require('gulp-if');
var argv = require('yargs').default('prod', false).default('jsConf', 'local_dev').argv;
var del = require('del');
var rev = require('gulp-rev');
var cleanCSS = require('gulp-clean-css');
var exec = require('child_process').exec;
var plumber = require('gulp-plumber');

var config = {
    prod: argv.prod, // production mode
    sourceMaps: false
};

// Bower dependencies
var resourcesDir = './app/Resources';
var resourcesDirDest = './web';

// Node dependencies
var nodeResourcesDir = './node_modules/';
var nodeResourcesDirDest = './web/vendor';

var jsDir = resourcesDir + '/js',
    cssDir = resourcesDir + '/css',
    sassDir = resourcesDir + '/sass',
    assetsDir = resourcesDir + '/assets';

var paths = {
    scripts: [jsDir + '/main.js', jsDir + '/**/*.js', '!' + jsDir + '/_specific/**/*.js', '!' + jsDir + '/vendor/**/*.js'],
    scriptsSpecifics: [jsDir + '/_specific/**/*.js'],
    scriptsVendors: require(assetsDir + '/vendor.js.json'),
    css: [cssDir + '/**/*.css']
};

gulp.task('default', function() {
    console.log('GULP THIS!');
});

gulp.task('clean', function() {
    return del(['./web/build/js/**/*', assetsDir + '/rev-manifest.json']);
});

gulp.task('watch', function() {

    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.scriptsSpecifics, ['scriptsSpecifics']);
    //gulp.watch(paths.css, ['css']);

    /*
    var vendors = paths.scriptsVendors;
    // on rajoute le watcher sur le fichier de liste directement
    vendors.push(assetsDir + '/vendor.js.json');
    gulp.watch(vendors, ['scriptsVendors']);

    gulp.watch(paths.scriptsVendors, ['scriptsVendors']);

    var vendorsNode = paths.scriptsVendorsNode;
    // on rajoute le watcher sur le fichier de liste directement
    vendorsNode.push(assetsDir + '/vendor_node.js.json');
    gulp.watch(vendorsNode, ['scriptsVendorsNode']);

    gulp.watch(paths.scriptsVendorsNode, ['scriptsVendors']);
    */

    /*
    gulp.watch([paths.sass, paths.sassPath], ['sass']);

    vendors = paths.cssVendors;
    // on rajoute le watcher sur le fichier de liste directement
    vendors.push(assetsDir + '/vendor.css.json');
    gulp.watch(vendors, ['css']);
    */

});


gulp.task('compile', ['clean'], function() {
    compileScriptsVendors();
    compileScripts();
    compileScriptsSpecifics();
    //compileCss();

    /*
    compileScriptsVendors();
    compileScriptsVendorsNode();
    sassCompile();
    cssCopy();
    compileScriptsSpecifics();
    dumpJsRoute();
    */
});

var compileScripts = function() {
    return processScripts(paths.scripts, resourcesDir, resourcesDirDest, true);
};
gulp.task('scripts', compileScripts);

var compileScriptsSpecifics = function() {
    return processScripts(paths.scriptsSpecifics, resourcesDir, resourcesDirDest, false);
};
gulp.task('scriptsSpecifics', compileScriptsSpecifics);

var compileScriptsVendors = function() {
    return processScriptsVendors(paths.scriptsVendors, resourcesDir, resourcesDirDest, true);
};
gulp.task('scriptsVendors', compileScriptsVendors);

var compileScriptsVendorsNode = function() {
    return processScripts(paths.scriptsVendorsNode, nodeResourcesDir, nodeResourcesDirDest, false);
};
gulp.task('scriptsVendorsNode', compileScriptsVendorsNode);

var compileCss = function() {
    return cssCopy(paths.css, resourcesDir, resourcesDirDest, true);
};
gulp.task('css', compileCss);

/**
 *
 * @param src string
 * @param base  string
 * @param dest  string
 * @param concatenation bool
 */
var processScripts = function(src, base, dest, concatenation) {

    return gulp.src(src, {base: base})
        .pipe(plumber())
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(gulpif(concatenation, concat('build/js/scripts.js')))
        .pipe(rev())
        .pipe(ngAnnotate({'single_quotes': true}))
        .pipe(gulpif(config.prod, uglify()))
        .pipe(gulpif(config.sourceMaps, sourcemaps.write()))
        .pipe(gulp.dest(dest))
        .pipe(rev.manifest(assetsDir + '/rev-manifest.json', {
            merge: true
        }))
        .pipe(gulp.dest('.'));
};

var processScriptsVendors = function(src, base, dest, concatenation) {

    return gulp.src(src, {base: base})
        .pipe(plumber())
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(gulpif(concatenation, concat('build/js/vendor.js')))
        .pipe(rev())
        .pipe(ngAnnotate({'single_quotes': true}))
        .pipe(gulpif(config.prod, uglify()))
        .pipe(gulpif(config.sourceMaps, sourcemaps.write()))
        .pipe(gulp.dest(dest))
        .pipe(rev.manifest(assetsDir + '/rev-manifest.json', {
            merge: true
        }))
        .pipe(gulp.dest('.'));
};

var sassCompile = function() {
    return gulp.src(paths.sass, {base: resourcesDir})
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(sass({outputStyle: config.prod ? 'compressed': 'nested'})).on('error', sass.logError)
        .pipe(rename('css/styles.css'))
        .pipe(rev())
        .pipe(gulpif(config.sourceMaps, sourcemaps.write()))
        .pipe(gulp.dest('./web'))
        .pipe(rev.manifest(assetsDir + '/rev-manifest.json', {
            merge: true
        }))
        .pipe(gulp.dest('.'));
};
//gulp.task('sass', sassCompile);

/*var processCss = function(src, base, dest, concatenation) {
    return gulp.src(src, {base: base})
        .pipe(plumber())
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(gulpif(concatenation, concat('build/css/bootstrap.min.css')))
        .pipe(rev())
        .pipe(gulpif(config.sourceMaps, sourcemaps.write()))
        .pipe(gulp.dest('./web'))
        .pipe(rev.manifest(assetsDir + '/rev-manifest.json', {
            merge: true
        }))
        .pipe(gulp.dest('.'));
};*/

/**
 * Copie les CSS des vendors en les minimisant mais sans les compiler.
 */
var cssCopy = function() {
    return gulp.src(paths.css, {base: resourcesDir})
        .pipe(gulpif(config.sourceMaps, sourcemaps.init()))
        .pipe(rev())
        .pipe(gulpif(config.prod, cleanCSS()))
        .pipe(gulpif(config.sourceMaps, sourcemaps.write()))
        .pipe(gulp.dest('./web'))
        .pipe(rev.manifest(assetsDir + '/rev-manifest.json', {
            merge: true
        }))
        .pipe(gulp.dest('.'));
};
//gulp.task('css', cssCopy);

var dumpJsRoute = function() {
    exec('bin/console fos:js-routing:dump', function(err, stdout, stderr) {
        if ('' !== stderr) {
            console.log(stderr);
        }
    });
};
gulp.task('dumpJsRoute', dumpJsRoute);
