<script>
  import Sidebar from '@/components/UI/Sidebar'
  import Navbar from '@/components/UI/Navbar'
  import links from '../../config/links'
  import navbarRightLinks from '../../config/navbarRightLinks'

  export default {
    name: 'Structure',
    components: {
      Sidebar,
      Navbar
    },
    computed: {
      links() {
        return links()
      },
      navbarRightLinks() {
        return navbarRightLinks()
      }
    }
  }
</script>

<template>
    <div class="d-flex">
        <sidebar :links="links"/>
        <div class="main">
            <navbar :links="navbarRightLinks"/>
            <main class="content">
                <slot/>
            </main>
        </div>
    </div>
</template>