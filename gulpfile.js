var Promise         = require('es6-promise').Promise,
    gulp            = require('gulp'),
    colors          = require('colors'),
    del             = require('del'),
    argv            = require('yargs').argv,
    gulpif          = require('gulp-if'),
    sourcemaps      = require('gulp-sourcemaps'),
    postcss         = require('gulp-postcss'),
    sass            = require('gulp-sass'),
    sasslint        = require('gulp-sass-lint'),
    autoprefixer    = require('autoprefixer'),
    cssnano        = require('cssnano'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify'),
    jshint          = require('gulp-jshint'),
    imagemin        = require('gulp-imagemin'),
    pngquant        = require('imagemin-pngquant'),
    mkdirp          = require('mkdirp'),
    createFile      = require('create-file'),
    zip             = require('gulp-zip');
//=======options==============================================================================
var css_file    = "foundation",
    css_src     = "assets/scss",
    css_dest    = "assets/stylesheets",
    //js locations
    js_file     = "foundation",
    js_src      = "assets/javascript/custom",
    js_dest     = "assets/javascript",
    //image locations
    image_src   = "images",
    image_dest  = "images";

//=======swallow error so doesn't stop watch=================================================
var swallowError = function(error){
  console.log(error.toString());
  this.emit('end');
};

//=======help=================================================================================
function helpTask(cb){
  console.log("*********************************************************************************".bold.white.bgYellow);
  console.log("css                = sourcemaps | sass | prefix | minimize | filesize".cyan);
  console.log("checkjs            = jslint | filesize (only site.js)".yellow);
  console.log("js                 = concat | uglify | filesize".yellow);
  console.log("image              = optimize images and save to build dir".magenta);
  console.log("---------------------------------------------------------------------------------".america);
  console.log("watch (default)    = css, checkjs, js".bold.green);
  console.log("build              = css, js, & image + moves scaffold and other folders to build".bold.green);
  console.log("package            = all build files and files in root copied to package/".bold.blue);
  console.log("clean              = deletes package and build directories and package.zip".bold.blue);
  console.log("*********************************************************************************".bold.white.bgYellow);
  cb();
};
exports.help = helpTask;

//=======stylesheet===========================================================================
//sourcemaps | sass | prefix | minimize
function cssTask(){
  var processors = [autoprefixer({browsers:['last 2 versions', 'ie >= 9', 'android >= 4.4', 'ios >= 7']}),cssnano];
  return gulp.src(css_src + '/' +css_file + '.scss')
  .pipe(sasslint())
  .pipe(sasslint.format())
  .pipe(sourcemaps.init())
  .pipe(sass())
  .on('error', swallowError)
  .pipe(postcss(processors))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(css_dest));
};
exports.css = cssTask;

//=======javascript===========================================================================
//concat
function jsCatTask(){
  return gulp.src([

    // Foundation core
    'assets/components/foundation/js/foundation/foundation.js',

    // Pick the componenets you need in your project
    //'assets/components/foundation/js/foundation/foundation.abide.js',
    //'assets/components/foundation/js/foundation/foundation.accordion.js',
    //'assets/components/foundation/js/foundation/foundation.alert.js',
    //'assets/components/foundation/js/foundation/foundation.clearing.js',
    //'assets/components/foundation/js/foundation/foundation.dropdown.js',
    'assets/components/foundation/js/foundation/foundation.equalizer.js',
    //'assets/components/foundation/js/foundation/foundation.interchange.js',
    'assets/components/foundation/js/foundation/foundation.joyride.js',
    'assets/components/foundation/js/foundation/foundation.magellan.js',
    'assets/components/foundation/js/foundation/foundation.offcanvas.js',
    //'assets/components/foundation/js/foundation/foundation.orbit.js',
    'assets/components/foundation/js/foundation/foundation.reveal.js',
    //'assets/components/foundation/js/foundation/foundation.slider.js',
    //'assets/components/foundation/js/foundation/foundation.tab.js',
    //'assets/components/foundation/js/foundation/foundation.tooltip.js',
    'assets/components/foundation/js/foundation/foundation.topbar.js',

    // Include your own custom scripts (located in the custom folder)
    'assets/javascript/custom/*.js'

  ])
  .pipe(concat(js_file + '.js'))
  .pipe(gulp.dest(js_dest));
};
exports.jsCat = jsCatTask;

//jshint
function checkjsTask (){
  return gulp.src([js_src + '/**/*.js'])
  .pipe(jshint())
  .on('error', swallowError)
  .pipe(jshint.reporter('jshint-stylish'));
};
exports.checkjs = checkjsTask;

//uglify
function jsUglyTask(){
  return gulp.src(js_dest + '/' + js_file + '.js')
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(js_dest));
};
exports.jsUgly = jsUglyTask;
//=======images===============================================================================
function imageTask(){
  return gulp.src(image_src + '/**')
  .pipe(imagemin({
      progressive: true,
      svgPlugins: [{removeViewBox: false}],
      use: [pngquant()]
  }))
  .pipe(gulp.dest(image_dest));
};
exports.image = imageTask;

//=======watch================================================================================
function watchTask(){
  gulp.watch(css_src + '/**/*.scss', cssTask);
  gulp.watch(js_src + '/**/*.js', gulp.series(checkjsTask, jsCatTask));
};
exports.watch = watchTask;

//=======move files around==============================================================================

function moveFontsTask(){
  return gulp.src(['assets/components/fontawesome/fonts/**'])
  .pipe(gulp.dest('assets/fonts'));
};
exports.moveFonts = moveFontsTask;

//=======BUILD================================================================================
exports.build = gulp.series(
                  gulp.parallel(cssTask, imageTask, gulp.series(jsCatTask, jsUglyTask)),
                  gulp.parallel(moveFontsTask)
                );
//=======PACKAGE==============================================================================
function zipTask(){
  return gulp.src(['package/**/*'],{dot:true})
  .pipe(zip('package.zip'))
  .pipe(gulp.dest('package'));
};
exports.zip = zipTask;

function cleanPackageTask(cb){
  del(['package/**/*', '!package/package.zip'],{dot:true});
  cb();
};
exports.cleanPackage = cleanPackageTask;

function packageFilesTask(){
  return gulp.src([
    '**/*',
    '!**/.git/**',
    '!**/.gitignore',
    '!**/node_modules/**',
    '!**/components/**',
    '!**/custom/**',
    '!**/scss/**',
    '!**/package/**',
    '!**/.sass-lint.yml',
    '!**/package-lock.jsom',
    '!**/shortcode_cheats.txt',
    '!**/gulpfile.js',
    '!**/package.json',
    '!**/README.md',
  ],{dot:true})
  .pipe(gulp.dest('package/'));
};
exports.package = gulp.series(packageFilesTask, zipTask, cleanPackageTask);
//=======CLEAN================================================================================
function cleanTask(cb){
  del('assets/stylesheets');
  del('assets/javascript/foundation.js')
  del('package/**');
  cb();
};
exports.clean = cleanTask;
//default Task
exports.default = watchTask;
