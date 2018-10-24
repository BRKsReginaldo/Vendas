const Mutations = {
  install(Vue, config) {
    this.mutations = config.mutations

    Vue.prototype.mutate = this.mutate.bind(this)
    Vue.mutate = this.mutate.bind(this)
  },
  mutate(key, ...args) {
    if (!this.mutations.hasOwnProperty(key)) throw new Error(`Mutation not found [${key}]`)
    return this.mutations[key](...args)
  }
}

export default Mutations