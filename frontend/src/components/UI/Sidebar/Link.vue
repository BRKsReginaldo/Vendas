<script>
    export default {
      name: 'Link',
      props: {
        link: {
          required: true,
          type: String
        },
        icon: {
          required: false,
          type: String
        },
        title: {
          required: true,
          type: String
        },
        badge: {
          required: false,
          type: [Object, null]
        }
      }
    }
</script>

<template>
    <div class="sidebar-item">
        <router-link :to="$props.link" class="sidebar-link">
            <span v-if="$props.icon" :class="['align-middle', 'feather', $props.icon]"/>
            <span class="align-middle" v-text="$props.title"/>
            <span v-if="$props.badge" :class="['sidebar-badge', 'badge', `badge-${$props.badge.type}`]" v-text="$props.badge.value"/>
        </router-link>
    </div>
</template>