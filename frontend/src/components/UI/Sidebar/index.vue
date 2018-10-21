<script>
  import LinkBag from './LinkBag'
  import SidebarFooter from './Footer'
  import {mapGetters} from 'vuex'

  export default {
    name: 'Navbar',
    components: {
      LinkBag,
      SidebarFooter
    },
    props: {
      links: {
        type: Array,
        required: true
      }
    },
    computed: {
      ...mapGetters({
        open: 'ui/sidebarOpen'
      })
    }
  }
</script>

<template>
    <nav :class="{'sidebar': true, 'toggled': !open}">
        <div class="sidebar-content">
            <router-link to="/" class="sidebar-brand">
                <img src="@/assets/logo.png" class=" align-middle sidebar-brand-icon"/>
                <span class="align-middle">JaPronto</span>
            </router-link>
            <link-bag :links="$props.links"/>
        </div>
        <sidebar-footer/>
    </nav>
</template>