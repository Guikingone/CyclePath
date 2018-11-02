let Encore = require('@symfony/webpack-encore');
let CopyWebpackPlugin = require("copy-webpack-plugin");

Encore.setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureUglifyJsPlugin()
    .configureBabel(function(babel) {
        babel.presets = ['es2015'];
    })
    .enableSassLoader(function(options) {
        options.includePaths = ['./node_modules'];
    })
    .addLoader(
        {
            test: /\.js$/,
            loader: 'babel-loader',
            query: {
                presets: ['es2015'],
                plugins: ['transform-object-assign']
            },
        }
    )
    .addPlugin(new CopyWebpackPlugin([
        {
            from: "node_modules/@webcomponents/webcomponentsjs/*.js",
            to: "webcomponents/",
            flatten: true
        }
    ]))

    // CSS
    .addStyleEntry('app-shell', './assets/scss/public/app-shell.scss')
    .addStyleEntry('register', './assets/scss/public/register.scss')

    // Javascript
    .addEntry('app-shell-js', './assets/js/public/app-shell.js')
    .addEntry('home-js', './assets/js/public/home.js')
    .addEntry('register-js', './assets/js/public/register.js')
;

module.exports = Encore.getWebpackConfig();
