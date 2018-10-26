<script>
  import withUser from '@/mixins/withUser'
  import dataTable from '@/mixins/dataTable'
  import {VuetableRowHeader} from 'vuetable-2'

  export default {
    name: 'List',
    components: {
      VuetableRowHeader
    },
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
      },
      slots: {
        type: Array,
        required: false,
        default: () => []
      }
    },
    data: () => ({
      setupPagination: false,
    }),
    computed: {
      formatedFields() {
        return !this.$props.hasActions ? this.$props.fields : [
          ...this.$props.fields,
          {
            name: 'actions-slot',
            title: $t('labels.actions')
          }
        ]
      },
      page() {
        return this.$route.query.page
      },
      search() {
        return this.$route.query.search || ''
      }
    },
    watch: {
      search(search) {
        this.makeSearch(search)
      }
    },
    methods: {
      reload() {
        return this.$refs.vuetable.reload()
      },
      buildQuery(sortOrder, currentPage, perPage) {
        return {
          sort: sortOrder.length ? `${sortOrder[0].field}|${sortOrder[0].direction || 'asc'}` : '',
          page: currentPage,
          per_page: perPage,
          search: this.search
        }
      },
      onChangePage(page) {
        this.$router.push({
          query: {
            ...this.$route.query,
            page
          }
        })

        window.requestAnimationFrame(() => {
          window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
          })
        })

        this.$refs.vuetable.changePage(page)
      },
      transformData(data) {
        this.$refs.pagination.setPaginationData(data)

        return data
      },
      initVuetable() {
        if (!this.$data.setupPagination && this.$route.query.page) {
          this.$data.setupPagination = true
          this.onChangePage(this.$route.query.page)
        }
      },
      async makeSearch(search) {
        this.$router.push({
          query: {
            ...this.$route.query,
            search: search.trim()
          }
        })

        await this.$refs.vuetable.reload()
      },
      async onChangeSearch(ev) {
        const search = ev.target.value

        await this.makeSearch(search)

        if (this.$route.query.page && this.$route.query.page.toString() !== '1') this.onChangePage(1)
      }
    }
  }
</script>

<template>
    <div>
        <vue-table
                ref="vuetable"
                :api-url="$props.url"
                :fields="formatedFields"
                data-path="data"
                :query-params="buildQuery"
                :transform="transformData"
                :http-options="requestAuth"
                pagination-path="meta"
                :css="$data.css.table"
                :first-page="1"
                @vuetable:pagination-data="initVuetable"
                :no-data-template="$t('placeholders.noData')"
        >
            <template slot="tableHeader" slot-scope="{fields}">
                <vuetable-row-header/>
                <tr>
                    <th :colspan="fields.length">
                        <input
                                @keyup.enter="onChangeSearch"
                                type="text"
                                class="form-control"
                                placeholder="Digite alguma coisa para pesquisar...">
                    </th>
                </tr>
            </template>
            <div style="min-width: 150px"
                 slot="actions-slot"
                 slot-scope="{rowData}">
                <slot v-if="hasActions" name="actions" :row-data="rowData"/>
            </div>
            <template v-for="slot in slots"
                      :slot="slot"
                      slot-scope="{rowData}">
                <slot :name="`${slot}-slot`" :row-data="rowData"/>
            </template>
        </vue-table>
        <vuetable-pagination :css="$data.css.pagination"
                             ref="pagination"
                             :limit="2"
                             @vuetable-pagination:change-page="onChangePage"/>

    </div>
</template>