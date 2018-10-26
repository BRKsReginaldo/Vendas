<script>
  import RenderPagination from './RenderPagination.vue'

  export default {
    name: 'Pagination',
    components: {
      RenderPagination,
    },
    props: {
      limit: {
        type: Number,
        default: 1
      }
    },
    data: () => ({
      paginationData: {}
    }),
    methods: {
      setPaginationData(data) {
        this.$data.paginationData = data
      },
      onPaginationChangePage (page) {
        this.$emit('vuetable-pagination:change-page', page);
      }
    }
  }
</script>

<template>
    <render-pagination :data="paginationData" :limit="limit" v-on:pagination-change-page="onPaginationChangePage">
        <ul class="pagination justify-content-center mt-3 bg-light" v-if="computed.total > computed.perPage"
            slot-scope="{ data, limit, computed, prevButtonEvents, nextButtonEvents, pageButtonEvents }">
            <li class="page-item pagination-prev-nav" v-if="computed.prevPageUrl">
                <a class="page-link" href="#" aria-label="Previous" v-on="prevButtonEvents">
                    <slot name="prev-nav">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </slot>
                </a>
            </li>
            <li class="page-item pagination-page-nav" v-for="(page, key) in computed.pageRange" :key="key"
                :class="{ 'active': page == computed.currentPage }">
                <a class="page-link" href="#" v-on="pageButtonEvents(page)">{{ page }}</a>
            </li>
            <li class="page-item pagination-next-nav" v-if="computed.nextPageUrl">
                <a class="page-link" href="#" aria-label="Next" v-on="nextButtonEvents">
                    <slot name="next-nav">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Próximo</span>
                    </slot>
                </a>
            </li>
        </ul>
    </render-pagination>
</template>