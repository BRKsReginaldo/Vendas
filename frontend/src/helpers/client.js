import axios from 'axios'
import Raven from 'raven-js'
import store from '../store'

const getClient = (baseURL = null, customOptions = {}) => {
  const options = {
    ...customOptions,
    baseURL
  }

  options.headers = {
    ...options.headers,
    'X-Requested-With': 'XMLHttpRequest'
  }

  if (store.getters['auth/credentials']) {
    options.headers = {
      ...options.headers,
      Authorization: `Bearer ${store.getters['auth/credentials'].access_token}`
    }
  }

  const client = axios.create(options)

  client.interceptors.request.use(
    requestConfig => requestConfig,
    requestError => {
      Raven.captureException(requestError)

      return Promise.reject(requestError)
    })

  client.interceptors.response.use(
    response => response,
    error => {
      if (error.response.status >= 500) {
        Raven.captureException(error)
      }

      return Promise.reject(error)
    }
  )

  return client
}

class ApiClient {
  constructor(baseUrl = null) {
    this.client = getClient(baseUrl)
  }

  get(url, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.get(url, conf)
        .then(resolve)
        .catch(reject))
  }

  delete(url, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.delete(url, conf)
        .then(resolve)
        .catch(reject))
  }

  laravelDelete(url, data = {}, conf = {}) {
    data._method = 'delete'
    return new Promise((resolve, reject) =>
      this.client.post(url, data, conf)
        .then(resolve)
        .catch(reject))
  }

  head(url, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.head(url, conf)
        .then(resolve)
        .catch(reject))
  }

  options(url, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.options(url, conf)
        .then(resolve)
        .catch(reject))
  }

  post(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.post(url, data, conf)
        .then(resolve)
        .catch(reject))
  }

  put(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.put(url, data, conf)
        .then(resolve)
        .catch(reject))
  }

  laravelPut(url, data = {}, conf = {}) {
    data._method = 'put'
    return new Promise((resolve, reject) =>
      this.client.post(url, data, conf)
        .then(resolve)
        .catch(reject))
  }

  patch(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      this.client.patch(url, data, conf)
        .then(resolve)
        .catch(reject))
  }

  laravelPatch(url, data = {}, conf = {}) {
    data._method = 'patch'
    return new Promise((resolve, reject) =>
      this.client.post(url, data, conf)
        .then(resolve)
        .catch(reject))
  }
}

export {ApiClient}

export default {
  get(url, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().get(url, conf)
        .then(resolve)
        .catch(reject))
  },

  delete(url, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().delete(url, conf)
        .then(resolve)
        .catch(reject))
  },

  laravelDelete(url, data = {}, conf = {}) {
    data._method = 'delete'
    return new Promise((resolve, reject) =>
      getClient().post(url, data, conf)
        .then(resolve)
        .catch(reject))
  },

  head(url, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().head(url, conf)
        .then(resolve)
        .catch(reject))
  },

  options(url, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().options(url, conf)
        .then(resolve)
        .catch(reject))
  },

  post(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().post(url, data, conf)
        .then(resolve)
        .catch(reject))
  },

  put(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().put(url, data, conf)
        .then(resolve)
        .catch(reject))
  },

  laravelPut(url, data = {}, conf = {}) {
    if (data.constructor === FormData) data.append('_method', 'put')
    else data._method = 'put'
    return new Promise((resolve, reject) =>
      getClient().post(url, data, conf)
        .then(resolve)
        .catch(reject))
  },

  patch(url, data = {}, conf = {}) {
    return new Promise((resolve, reject) =>
      getClient().patch(url, data, conf)
        .then(resolve)
        .catch(reject))
  },

  laravelPatch(url, data = {}, conf = {}) {
    if (data.constructor === FormData) data.append('_method', 'patch')
    else data._method = 'patch'
    return new Promise((resolve, reject) =>
      getClient().post(url, data, conf)
        .then(resolve)
        .catch(reject))
  }
}