import Vue from 'vue'
import Meta from 'vue-meta'

Vue.use(Meta, {
  keyName: 'meta',
  attribute: 'data-vue-meta',
  ssrAttribute: 'data-vue-meta-server-rendered',
  tagIDKeyName: 'vmid'
})