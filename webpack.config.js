const path = require('path');

module.exports = {
  entry: './src/Views/components/index.js',
  devtool: "source-map",
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'public/js'),
  },
  mode: 'production',
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
              ['minify']
            ]
          }
        }
      }
    ]
  }
};