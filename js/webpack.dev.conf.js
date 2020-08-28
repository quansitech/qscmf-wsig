const path = require('path');
const merge = require('webpack-merge');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const baseConfig = require('./webpack.base.conf.js');

module.exports = merge(baseConfig, {
    mode: 'development',
    devtool: 'inline-source-map',
    devServer: {
        port: 3001
    },
    plugins: [
        new HtmlWebpackPlugin({
            inject: 'head',
            template: path.join(__dirname, 'src', 'index.ejs')
        })
    ]
});