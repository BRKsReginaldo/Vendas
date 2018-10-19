<script>
    export default {
      name: 'ErrorList',
      props: {
        errors: {
          required: true
        }
      }
    }
</script>

<template>
    <div class="text-danger m-2">
        <div v-if="errors && errors.length" v-for="error in errors" :key="error">{{ error}}</div>
    </div>
</template>