const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');

module.exports = (env, argv) => {
  const devMode = 'production' !== argv.mode;

  return {
    context: __dirname,
    entry: {
      bundle: './src/index.js',
      customizer: './src/js/customizer.js',
      style: './src/sass/style.scss',
      'editor-style': './src/sass/editor-style.scss'
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: devMode ? '[name].js' : '[name].min.[hash].js'
    },
    mode: argv.mode,
    devtool: 'source-map',
    externals: {
      jquery: 'jQuery'
    },
    module: {
      rules: [
        {
          enforce: 'pre',
          exclude: /node_modules/,
          test: /\.jsx$/,
          loader: 'eslint-loader'
        },
        {
          test: /\.jsx?$/,
          loader: 'babel-loader'
        },
        {
          test: /\.s?css$/,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
        },
        {
          test: /\.svg$/,
          loader: 'svg-sprite-loader',
          options: {
            extract: true,
            spriteFilename: 'svg-defs.svg'
          }
        },
        {
          test: /\.(jpe?g|png|gif)$/,
          use: [
            {
              loader: 'file-loader',
              options: {
                outputPath: 'images/',
                name: '[name].[ext]'
              }
            }
          ]
        }
      ]
    },
    plugins: [
      // new StyleLintPlugin(),
      new FixStyleOnlyEntriesPlugin(),
      new CleanWebpackPlugin(['dist', '*.css', '*.map'], {
        exclude: ['rtl.css']
      }),
      new ManifestPlugin({
        fileName: 'manifest.json',
        filter: ({ name }) => !name.endsWith('.map')
      }),
      new MiniCssExtractPlugin({
        filename: devMode ? '../[name].css' : '../[name].[hash].css',
        chunkFilename: devMode ? '../[id].css' : '../[id].[hash].css'
      }),
      new SpriteLoaderPlugin(),
      new BrowserSyncPlugin({
        files: '**/*.php',
        injectChanges: true,
        proxy: 'http://defense360:8888/'
      })
    ],
    optimization: {
      minimizer: [
        new UglifyJSPlugin({
          cache: true,
          parallel: true,
          sourceMap: devMode
        }),
        new OptimizeCSSAssetsPlugin({
          cssProcessor: require('cssnano'),
          cssProcessorOptions: {
            discardDuplicates: { removeAll: true },
            discardComments: { removeAll: true }
          }
        })
      ]
    }
  };
};
