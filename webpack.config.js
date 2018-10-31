let Encore = require('@symfony/webpack-encore');
let CopyWebpackPlugin = require("copy-webpack-plugin");

Encore.setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    .addLoader(
        {
            test: /\.scss$/,
            use: [
                {
                    loader: 'sass-loader',
                    options: {
                        importer: function(url, prev) {
                            if(url.indexOf('@material') === 0) {
                                const filePath = url.split('@material')[1];
                                const nodeModulePath = `./node_modules/@material/${filePath}`;
                                return {
                                    file: require('path').resolve(nodeModulePath)
                                };
                            }
                            return {
                                file: url
                            };
                        }
                    }
                }
            ]
        },
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

    // Javascript
    .addEntry('app-shell-js', './assets/js/public/app-shell.js')
    .addEntry('register', './assets/js/public/register.js')
;

if (Encore.isProduction()) {
    Encore
        .enableVersioning()
        .configureUglifyJsPlugin()
    ;
}

module.exports = Encore.getWebpackConfig();
