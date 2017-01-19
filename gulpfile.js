const elixir = require('laravel-elixir');
const webpack = require("webpack");
const webpackConfig = require('./webpack.config')
const gulp = require('gulp');

require('laravel-elixir-vue-2')
var config = Object.create(webpackConfig);

elixir(mix => {

});

gulp.task('webpack', function(callback) {
    var config = Object.create(webpackConfig);
    webpack(config, function(err, stats) {
        callback();
    });
});
