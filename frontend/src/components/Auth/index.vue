<script>
  import Structure from '@/components/Structure'

  export default {
    name: 'Auth',
    components: {
      Structure
    },
    computed: {
      user() {
        return this.$store.getters['auth/user']
      },
      sidebar() {
        return this.$store.getters['ui/sidebarOpen']
      }
    },
    mounted() {
      window.addEventListener('resize', this.onResize)
    },
    destroyed() {
      window.removeEventListener('resize', this.onResize)
    },
    methods: {
      setSidebar(show) {
        this.$store.dispatch('ui/setSidebarOpen', show)
      },
      onResize(ev) {
        if (window.matchMedia(`(min-width: 992px)`).matches) {
          if (!this.sidebar) {
            this.setSidebar(true)
          }
        } else {
          if (this.sidebar) {
            this.setSidebar(false)
          }
        }
      }
    }
  }
</script>

<template>
    <structure>
        <template v-if="!!user">
            <router-view/>
        </template>
        <div v-else class="text-center m-5">
            <span class="fas fa-spin fa-spinner fa-5x"/>
        </div>
    </structure>
</template>
