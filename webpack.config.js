const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

module.exports = {
  entry: './client/index.js',
  devtool: "source-map",
  resolve: {
    alias: {
      '@default': path.resolve(__dirname, 'client/default/'),
      '@services': path.resolve(__dirname, 'client/app/core/services/'),
      '@components': path.resolve(__dirname, 'client/app/components/'),
      '@pages': path.resolve(__dirname, 'client/app/pages/'),
      '@core': path.resolve(__dirname, 'client/app/core/')
    }
  },
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'public_html/dist/js'),
  },
  mode: 'development',
  module: {
    rules: [
      {
        test: /\.(?:js|mjs|cjs)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            targets: "defaults",
            presets: [
              ['@babel/preset-env', { targets: "defaults" }],
              ['minify']
            ]
          }
        }
      },
      {
        use: ["html-loader"],
        test: /\.html$/i,
      },
      {
        test: /\.(css|sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { sourceMap: true, url: false }
          },
          {
            loader: 'sass-loader',
            options: { sourceMap: true }
          }
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '../css/main.css'
    })
  ],
  optimization: {
    minimize: true,
    minimizer: [new CssMinimizerPlugin()],
  },
};