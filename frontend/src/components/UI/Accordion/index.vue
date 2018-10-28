<script>
  export default {
    name: 'Accordion',
    props: {
      shown: {
        type: Boolean,
        default: () => true
      }
    },
    data: () => ({
      show: true
    }),
    methods: {
      beforeEnter(el) {
        el.style.height = '0'
      },
      enter(el) {
        el.style.height = `${el.scrollHeight}px`
      },
      beforeLeave(el) {
        el.style.height = `${el.scrollHeight}px`
      },
      leave(el) {
        el.style.height = '0'
      },
      toggle() {
        this.$data.show = !this.$data.show
      }
    },
    mounted() {
      this.$data.show = this.$props.shown
    }
  }
</script>

<template>
    <div class="card mb-2">
        <div class="card-header pointer" @click="toggle">
            <h5 class="mb-0">
                <slot name="header"/>
            </h5>
        </div>
        <transition
                name="accordion"
                @before-enter="beforeEnter"
                @enter="enter"
                @before-leave="beforeLeave"
                @leave="leave"
        >
            <div v-show="show" class="card-body">
                <slot/>
            </div>
        </transition>
    </div>
</template>