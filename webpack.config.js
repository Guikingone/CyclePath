let Encore = require('@symfony/webpack-encore');

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
        }
    )

    .addStyleEntry('app-shell', './assets/scss/public/app-shell.scss')
    .addEntry('topBar', './assets/js/public/TopBar.js')
    .addEntry('register', './assets/js/public/register.js')
;

if (Encore.isProduction()) {
    Encore
        .enableVersioning()
        .configureUglifyJsPlugin()
    ;
}

module.exports = Encore.getWebpackConfig();
