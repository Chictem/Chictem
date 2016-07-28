import gulp from 'gulp';
import less from 'gulp-less';
import rename from "gulp-rename";
import del from 'del';
import gulpLoadPlugins from 'gulp-load-plugins';
const $ = gulpLoadPlugins();

const bower_components_path = 'vendor/bower_components/';
const asset_components_path = 'resources/assets/';
const images_suffix = 'jpg,png,jpeg,bmp,gif,tiff';
const fonts_suffix = 'eot,svg,ttf,woff,woff2';
const scripts_path = asset_components_path + '**/*.js';
const images_path = asset_components_path + '**/*.{' + images_suffix + '}';
const fonts_path = asset_components_path + '**/*.{' + fonts_suffix + '}';
const extra_path = [asset_components_path + '**/*', '!' + asset_components_path + '**/*.{scss,sass,less,js,' + images_suffix + ',' + fonts_suffix + '}'];
var sass_path = [];
var less_path = [];

const argv = require('yargs').argv;
var themes = argv.themes;

if (themes) {
    themes = themes.split(',');
    themes.forEach((value) => {
        sass_path.push(asset_components_path + '**/themes/' + value + '/**/*.scss');
        less_path.push(asset_components_path + '**/themes/' + value + '/**/*.less');
    });
} else {
    sass_path.push(asset_components_path + '**/*.{scss,sass}');
    less_path.push(asset_components_path + '**/*.less');
}

gulp.task('vendor', () => {
    return gulp.src(bower_components_path + '/*/dist/**')
        .pipe($.plumber())
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/dist/g, '');
            path.basename = path.basename.replace(/^dist$/, '');
        }))
        .pipe(gulp.dest('public/vendor'));
});

gulp.task('sass', () => {
    return gulp.src(sass_path)
        .pipe($.plumber())
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/sass/g, '/css');
        }))
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            outputStyle: 'expanded',
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
        .pipe($.sourcemaps.write())
        .pipe(minifycss())
        .pipe(gulp.dest('public/'));
});

gulp.task('less', () => {
    return gulp.src(less_path)
        .pipe($.plumber())
        .pipe(rename((path) => {
            path.dirname = path.dirname.replace(/\/less/g, '/css');
        }))
        .pipe($.sourcemaps.init())
        .pipe(less())
        .pipe($.sourcemaps.write())
        .pipe(minifycss())
        .pipe(gulp.dest('public/'));
});

gulp.task('scripts', () => {
    return gulp.src(scripts_path)
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.babel())
        .pipe($.uglify())
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest('public'))
});

gulp.task('images', () => {
    return gulp.src(images_path)
        .pipe($.plumber())
        .pipe($.imagemin({
            progressive: true,
            interlaced: true,
            svgoPlugins: [{cleanupIDs: false}]
        }))
        .pipe(gulp.dest('public'));
});

gulp.task('fonts', () => {
    return gulp.src(fonts_path)
        .pipe($.plumber())
        .pipe(gulp.dest('public'));
});
gulp.task('extra', () => {
    return gulp.src(extra_path, {nodir: true})
        .pipe($.plumber())
        .pipe(gulp.dest('public'));
});

gulp.task('clean', del.bind(null, ['/public/vendor', '/public/manage', '/public/themes']));

gulp.task('build', ['vendor', 'sass', 'less', 'images', 'fonts', 'scripts', 'extra']);

gulp.task('default', ['clean'], () => {
    gulp.start('build');
});

gulp.task('watch', () => {
    gulp.watch(sass_path, ['sass']);
    gulp.watch(less_path, ['less']);
    gulp.watch(scripts_path, ['scripts']);
    gulp.watch(images_path, ['images']);
    gulp.watch(fonts_path, ['fonts']);
    gulp.watch(extra_path, ['extra']);
});

