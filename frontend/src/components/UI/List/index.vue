<script>
  import withUser from '@/mixins/withUser'
  import dataTable from '@/mixins/dataTable'

  export default {
    name: 'List',
    mixins: [withUser, dataTable],
    props: {
      fields: {
        type: Array,
        required: true
      },
      url: {
        type: String,
        required: true
      },
      hasActions: {
        type: Boolean
      }
    },
    computed: {
      formatedFields() {
        return !this.$props.hasActions ? this.$props.fields : [
          ...this.$props.fields,
          {
            name: 'actions-slot',
            title: $t('labels.actions')
          }
        ]
      }
    },
    methods: {
      reload() {
        return this.$refs.vuetable.reload()
      }
    }
  }
</script>

<template>
    <vue-table
            ref="vuetable"
            :api-url="$props.url"
            :fields="formatedFields"
            data-path="data"
            :http-options="requestAuth"
            pagination-path="meta"
            :css="$data.css.table"
            :no-data-template="$t('placeholders.noData')"
    >
        <div slot="actions-slot" slot-scope="{rowData}">
            <slot v-if="hasActions" name="actions" :row-data="rowData"/>
        </div>
    </vue-table>
</template>