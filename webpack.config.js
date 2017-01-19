var webpack = require('webpack')

module.exports = {
    //页面入口文件配置
    entry: './resources/assets/js/app.js',
    //入口文件输出配置
    output: {
        path: './public/js',
        filename: '[name].bundle.js'// 存放到 ./public/js 文件夹下。
    },
    //新建一个开发服务器，并且当代码更新的时候自动刷新浏览器。
    devServer: {
        historyApiFallback: true,
        noInfo: true,
        hot: true,
        inline: true,
        progress: true,
        port:9090 //端口你可以自定义
    },
    module: {
        // module.loaders 是最关键的一块配置。它告知 webpack每一种文件都需要使用什么加载器来处理：
        loaders: [{
            test: /\.js$/,
            exclude: /node_modules/,
            loader: 'babel-loader'
        }, {
            test: /\.vue$/,
            loader: 'vue'
        }, {
            test: /\.png$/,
            loader: 'url-loader',
            query: { mimetype: 'image/png' }
        }]
    },
    devtool: 'source-map',//由于打包后的代码是合并以后的代码，不利于排错和定位，只需要在config中添加，这样出错以后就会采用source-map的形式直接显示你出错代码的位置。
    plugins: []
}
