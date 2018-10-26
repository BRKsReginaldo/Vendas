<script>
  import AsyncFileReader from "../../helpers/AsyncFileReader"

  export default {
    name: 'ImageInput',
    props: {
      src: {
        required: true
      },
      name: {
        type: String,
        default: () => 'image'
      },
      imgStyle: {
        type: [Object, String],
        default: () => ({})
      }
    },
    data: () => ({imageFile: null, imagePreview: null}),
    computed: {
      imgSrc() {
        if (this.imagePreview) return this.imagePreview
        return this.src
      }
    },
    methods: {
      async generatePreview(ev) {
        try {
          const file = ev.target.files[0]
          const reader = new AsyncFileReader()
          const result = await reader.readAsDataURL(file)

          this.$data.imageFile = file
          this.$data.imagePreview = result

          this.$emit('change', file)
        } catch(e) {
          unknownError()
        }
      }
    }
  }
</script>

<template>
    <div>
        <div class="form-group">
            <label>
                <slot/>
            </label>
            <input
                    @change="generatePreview"
                    type="file"
                    accept="image/*"
                    :name="name"
                    :id="name"
                    class="form-control">
        </div>
        <div v-show="imgSrc" class="m-2">
            <img
                    class="img-response img-fluid img-thumbnail"
                    :style="imgStyle"
                    :src="imgSrc"
                    :alt="`Preview ${name}`">
        </div>
    </div>
</template>