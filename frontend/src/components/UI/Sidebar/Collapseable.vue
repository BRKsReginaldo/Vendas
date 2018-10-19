<script>
  export default {
    name: 'Collapseable',
    components: {
      LinkBag: () => import('./LinkBag')
    },
    props: {
      links: {
        type: Array,
        required: true
      },
      id: {
        type: [String, Number],
        required: true
      },
      icon: {
        type: String,
        required: false
      },
      title: {
        type: String,
        required: true
      }
    }
  }
</script>

<template>
    <li class="sidebar-item">
        <a :href="'#menu-'+$props.id"
           class="sidebar-link collapsed"
           data-toggle="collapse">
            <span v-if="$props.icon" :class="['feather', 'align-middle', $props.icon]"/>
            <span class="align-middle" v-text="$props.title"/>
        </a>
        <ul :id="'menu-'+$props.id"
            class="sidebar-dropdown list-unstyled collapse">
            <link-bag :links="$props.links"/>
        </ul>
    </li>
</template>