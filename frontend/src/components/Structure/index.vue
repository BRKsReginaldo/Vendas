<script>
  import Sidebar from '@/components/UI/Sidebar'
  import Navbar from '@/components/UI/Navbar'
  import links from './links'

  export default {
    name: 'Structure',
    components: {
      Sidebar,
      Navbar
    },
    computed: {
      links() {
        return links()
      }
    }
  }
</script>

<template>
    <div class="d-flex">
        <sidebar :links="links"/>
        <div class="main">
            <navbar/>
            <main class="content">
                <slot/>
            </main>
        </div>
    </div>
</template>