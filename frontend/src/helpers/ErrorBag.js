class ErrorBag {
  constructor(errors = {}) {
    this.errors = errors
  }

  has = (key) => {
    return Object.keys(this.errors).indexOf(key) >= 0
  }

  get = (key) => {
    if (!this.has(key)) return []
    return this.errors[key]
  }

  any = () => {
    return Object.keys(this.errors).length > 0
  }
}

export default ErrorBag