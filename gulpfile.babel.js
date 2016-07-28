import gulp from 'gulp';
import less from 'gulp-less';
import gulpLoadPlugins from 'gulp-load-plugins';
gulpLoadPlugins({
    rename: {
        'gulp-less': 'less'
    }
});
import rename from "gulp-rename";
const bower_components_path = 'vendor/bower_components/';
const asset_components_path = 'resources/assets/';
const $ = gulpLoadPlugins();
var sass_path = new Array();
var less_path = [];
const argv = require('yargs').argv;
var themes = argv.themes;
if (themes) {
    themes = themes.split(',');
    themes.forEach((value) => {
        sass_path.push(asset_components_path + '**/themes/' + value + '/**/*.scss');
        less_path.push(asset_components_path + '**/themes/' + value + '/**/*.less');
    });
}
console.log(themes);
gulp.task('vendor', () => {
    return gulp.src(bower_components_path + '/*/dist/**')
        .pipe($.plumber())
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/dist/g, '');
            path.basename = path.basename.replace(/^dist$/, '');
        }))
        .pipe(gulp.dest('public/plugins'));
});
gulp.task('manage', () => {
    return gulp.src(asset_components_path + 'manage/sass/*.scss')
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'expanded',
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('public/manage/css'));
});
gulp.task('sass', () => {
    return gulp.src(sass_path)
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/sass/g, '/css');
        }))
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'expanded',
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('public/'));
});
gulp.task('less', () => {
    return gulp.src(less_path)
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/less/g, '/css');
        }))
        .pipe($.sourcemaps.init())
        .pipe(less())
        .pipe($.sourcemaps.write())
        .pipe(gulp.dest('public/'));
});