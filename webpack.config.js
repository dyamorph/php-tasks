const webpack = require('webpack');
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    mode: "production",
    entry: {
        main: './assets/js/main.js',
        form: './assets/js/form-validation.js',
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'assets/build')
    },
    module: {
        rules: [
            {
                test: /\.(sa|sc|c)ss$/,
                use: [MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader'
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: () => [
                                    require('auto-prefixer')
                                ]
                            }
                        }
                    },
                    {
                        loader: 'sass-loader'
                    },
                ]
            },
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: require.resolve('jquery'),
                loader: 'expose-loader',
                options: {
                    exposes: ['$', 'jQuery'],
                },
            },
        ],
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        new MiniCssExtractPlugin({
            filename: 'styles.css',
        }),
    ],
};
