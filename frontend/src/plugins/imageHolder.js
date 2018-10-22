import Vue from 'vue'

class ImageHolder {
  constructor() {
    this.attributes = {
      size: 200
    }
  }

  install(_Vue) {
    this._Vue = _Vue

    this._Vue.prototype.$imageHolder = this
  }

  setColor = color => {
    this.attributes.color = color

    return this
  }

  setSize = size => {
    this.attributes.size = size

    return this
  }

  setText = text => {
    this.attributes.text = text

    return this
  }

  setWidth = width => {
    this.attributes.width = width

    return this
  }

  setHeight = height => {
    this.attributes.height = height

    return this
  }

  buildUrl = () => {
    let url = 'https://via.placeholder.com'
    const width = this.attributes.width || this.attributes.size
    const height = this.attributes.height || this.attributes.size
    url+=`/${width.toString() === height.toString() ? width : [width,height].join('x')}`
    if (this.attributes.color) url+= `/${this.attributes.color}`
    url+='.png?'
    if (this.attributes.text) url+=`text=${encodeURIComponent(this.attributes.text)}`

    return url
  }
}

window.imageHolder = new ImageHolder
Vue.use(imageHolder)