<script>
    import withUser from '@/mixins/withUser'

    export default {
      name: 'Footer',
      mixins: [withUser]
    }
</script>

<template>
    <div class="sidebar-bottom d-none d-lg-block">
        <div class="media">
            <img :src="user.image" alt="Avatar" width="40" height="40" class="rounded-circle mr-3">
            <div class="media-body">
                <h5 class="mb-1 text-white">{{ user.name }}</h5>
            </div>
        </div>
    </div>
</template>