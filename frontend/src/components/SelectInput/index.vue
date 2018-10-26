<script>
  import Multiselect from 'vue-multiselect'
  import withUser from '@/mixins/withUser'
  import client from '@/helpers/client'
  import {debounce} from 'lodash'

  export default {
    name: 'SelectInput',
    components: {
      Multiselect
    },
    mixins: [withUser],
    props: {
      url: {
        type: String,
        required: true
      },
      name: {
        type: String
      },
      labelKey: {
        type: String,
        required: true
      },
      valueKey: {
        type: String,
        default: () => 'id'
      },
      value: {
        required: true
      },
      label: {
        type: String,
        required: false
      },
      placeholder: {
        type: String,
        default: () => 'Escolha uma opção'
      },
      customOption: {
        type: Boolean,
        default: () => false
      }
    },
    data: () => ({
      data: null,
      loading: false
    }),
    computed: {
      options() {
        if (this.data) return this.data.data
        return []
      },
      inputValue: {
        get() {
          if (this.options && this.$props.value) {
            let checkItem = item => item.id === this.$props.value.id
            let some = fn => this.options.some(fn)
            const find = fn => this.options.find(fn)
            if (some(checkItem))
              return find(checkItem)
          }
          return this.$props.value
        },
        set(value) {
          this.$emit('input', value)
        }
      }
    },
    methods: {
      async fetchOptions(search = '') {
        const res = await client.get(this.$props.url, {
          params: {
            search: encodeURIComponent(search),
            per_page: 30
          }
        })
        this.$data.data = res.data

      },
      onSearch(search) {
        this.loading = true
        this.setSearch(search, this)
      },
      setSearch: debounce((search, vm) => {
        vm.fetchOptions(search)
          .then(() => {
            vm.loading = false
          })
      }, 350)
    },
    mounted() {
      this.fetchOptions()
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<template>
    <div class="form-group">
        <slot/>
        <multiselect v-model="inputValue"
                     :options="options"
                     :track-by="valueKey"
                     @search-change="onSearch"
                     :loading="loading"
                     :placeholder="placeholder"
                     :allow-empty="false"
                     :no-result="$t('placeholders.no_result')"
                     :show-labels="true"
                     :select-label="$t('labels.select')"
                     :selected-label="$t('labels.selected')"
                     :deselect-label="$t('placeholders.unable_to_remove')"
                     :label="labelKey">
            <template slot="singleLabel" slot-scope="{option}">{{ option[$props.labelKey] }}</template>
            <template v-if="customOption" slot="option" slot-scope="{option}">
                <slot name="option" :option="option"/>
            </template>
        </multiselect>
    </div>
</template>