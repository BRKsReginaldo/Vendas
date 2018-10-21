<script>
  import Breadcrumbs from '@/components/UI/Breadcrumbs'

  export default {
    components: {
      Breadcrumbs
    },
    props: {
      fluid: Boolean
    }
  }
</script>

<template>
    <div>
        <breadcrumbs/>
        <div :class="$props.fluid ? 'container-fluid' : 'container'">
            <slot/>
        </div>
    </div>
</template>