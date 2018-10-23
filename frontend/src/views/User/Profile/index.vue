<script>
  import withUser from '@/mixins/withUser'
  import PasswordField from '@/components/UI/PasswordField'
  import ErrorBag from "../../../helpers/ErrorBag"
  import {mapActions} from 'vuex'
  import ImageInput from '@/components/ImageInput'

  export default {
    name: 'Profile',
    meta: {
      title: $t('pages.profile')
    },
    components: {
      PasswordField,
      ImageInput
    },
    mixins: [withUser],
    data: () => ({errors: new ErrorBag(), image: null}),
    watch: {
      confirming(show) {
        $('#updateConfirm').modal({show})
      }
    },
    mounted() {
      $('#updateConfirm').on('hidden.bs.modal', () => this.$data.confirming = false)
      $('#updateConfirm').on('shown.bs.modal', () => this.$data.confirming = true)
    },
    notifications: {
      showUpdateErrorNotification: {
        type: 'error',
        title: $t('notifications.title.error'),
        message: $t('notifications.message.user.update.error')
      }
    },
    methods: {
      ...mapActions({
        verifyPassword: 'auth/verifyPassword',
        updateUser: 'auth/updateUser'
      }),
      async onSubmit(ev) {
        ev.preventDefault()

        const formData = new FormData(ev.target)

        const matches = await this.verifyPassword()

        if (matches) {
          const result = await this.updateUser(formData)

          if (result.hasOwnProperty('errors')) {
            this.$data.errors = new ErrorBag(result.errors)
          }
        }

        return false
      },
      setImage(image) {
        this.$data.image = image
      }
    }
  }
</script>

<template>
    <page>
        <h1>Perfil</h1>
        <div class="card shadow mb-5">
            <div class="card-body">
                <form @submit.prevent="onSubmit">
                    <div class="row">
                        <div class="col-12">
                            <image-input
                                    :img-style="{maxWidth: '200px', maxHeight: '200px'}"
                                    :src="user.image"
                                    @change="setImage">
                                Imagem
                            </image-input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text"
                                       name="name"
                                       :value="user.name"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text"
                                       name="email"
                                       :value="user.email"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text"
                                       name="phone"
                                       :value="user.phone || ''"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <password-field/>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link to="/" class="btn btn-danger mr-1">Cancelar</router-link>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>