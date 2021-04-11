module.exports = {
  // local Laravel server address for api proxy
  devServer: { proxy: 'http://localhost:8000' },

  // outputDir should be Laravel public dir
  outputDir: '../../../public/',
  publicPath: '/',

  // for production we use blade template file
  indexPath: process.env.NODE_ENV === 'production'
    ? '../resources/views/app.blade.php'
    : 'index.html',
  pwa: {
    name: 'My App',
    themeColor: '#4DBA87',
    msTileColor: '#000000',
    appleMobileWebAppCapable: 'yes',
    appleMobileWebAppStatusBarStyle: 'black',

    // configure the workbox plugin
    workboxPluginMode: 'InjectManifest',
    workboxOptions: {
      // swSrc is required in InjectManifest mode.
      swSrc: 'dev/sw.js',
      // ...other Workbox options...
    },
    iconPaths: {
      favicon32: 'favicon.ico',
      favicon16: 'favicon.ico',
      appleTouchIcon: 'favicon.ico',
      maskIcon: 'favicon.ico',
      msTileImage: 'favicon.ico'
    }
  },
  chainWebpack: config => {
    config.module
      .rule('geojson')
      .test(/\.geojson$/)
      .use('json-loader')
      .loader('json-loader')
      .end()
  }
}
