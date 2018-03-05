var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .addEntry('admin', './frontend/admin/index.js')
    .addEntry('user', './frontend/user/index.js')
    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .enableVueLoader()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
;
var config = Encore.getWebpackConfig();

config.resolve.alias['uikit-icons'] = 'uikit/dist/js/uikit-icons.js';


module.exports = config;