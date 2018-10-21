<script>
  export default {
    name: 'Breadcrumbs',
    computed: {
      breadcrumbs() {
        return this.$router.history.current.meta.breadcrumbs || []
      }
    },
    mounted() {
      window.$router = this.$router
    }
  }
</script>

<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li v-for="breadcrumb in breadcrumbs" :key="breadcrumb.name" :class="{'breadcrumb-item': true, 'active': $router.history.current.name === breadcrumb.link.name}">
                <router-link :to="breadcrumb.link || '#'">{{ breadcrumb.name }}</router-link>
            </li>
        </ol>
    </nav>
</template>