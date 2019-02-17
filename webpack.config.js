var Encore = require('@symfony/webpack-encore');
Encore
// directory where all compiled assets will be stored
    .setOutputPath('public/js')
    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/')
    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // .createSharedEntry('vendor', 'babel-polyfill')
    .addEntry('game','./assets/js/GameUI/index.js')
    // Add react preset
    .enableReactPreset()
    // .enableSingleRuntimeChunk()
    .configureBabel(function (babelConfig) {
        // add additional presets
        // babelConfig.presets.push('es2015')
        babelConfig.plugins.push('@babel/transform-runtime');
// no plugins are added by default, but you can add some
        // babelConfig.plugins.push('styled-jsx/babel');
    })
    .enableSourceMaps(!Encore.isProduction())
;
// export the final configuration
module.exports = Encore.getWebpackConfig()