const path = require('path');
const merge = require('webpack-merge');
const baseConfig = require('./webpack.base.conf.js');

module.exports = merge(baseConfig, {
    mode: 'production',
    output: {
        filename: 'wysiwyg-bundle.js',
        path: path.join(__dirname, 'dist'),
        publicPath: '/Public/qscmf-wsig/'
    }
});