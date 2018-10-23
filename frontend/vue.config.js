const path = require('path')

module.exports = {
  outputDir: '../public',
  indexPath: process.env.NODE_ENV === 'production' ? '../resources/views/home.blade.php' : 'index.html',
  devServer: {
    proxy: 'http://10.0.26.82:8000'
  }
}