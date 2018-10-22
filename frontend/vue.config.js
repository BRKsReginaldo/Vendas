const path = require('path')

module.exports = {
  outputDir: '../public',
  indexPath: process.env.NODE_ENV === 'production' ? '../resources/views/home.blade.php' : 'index.html',
  devServer: {
    proxy: 'http://192.168.1.110:8000'
  }
}