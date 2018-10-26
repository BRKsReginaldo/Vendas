export default {
  table: {
    tableWrapper: 'table-responsive',
    tableHeaderClass: 'mb-0',
    tableBodyClass: 'mb-0',
    tableClass: 'table table-striped table-hover',
    loadingClass: 'loading',
    ascendingIcon: 'fa fa-chevron-up',
    descendingIcon: 'fa fa-chevron-down',
    ascendingClass: 'sorted-asc',
    descendingClass: 'sorted-desc',
    sortableIcon: 'fa fa-sort',
    detailRowClass: 'vuetable-detail-row',
    handleIcon: 'fa fa-bars text-secondary',
    renderIcon(classes, options) {
      return `<i class="${classes.join(' ')}" ${options}/>`
    }
  },
  pagination: {
    wrapperClass: 'pagination float-right mt-2 p-2',
    activeClass: 'active',
    disabledClass: 'disabled',
    pageClass: 'page-item',
    linkClass: 'page-link',
    paginationClass: 'pagination',
    paginationInfoClass: 'float-left',
    dropdownClass: 'form-control',
    icons: {
      first: 'fa fa-fast-backward',
      prev: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      last: 'fa fa-fast-forward',
    },
  }
}