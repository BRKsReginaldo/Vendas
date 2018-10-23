<script>
  import ErrorList from '@/components/UI/ErrorList'
  import PasswordField from '@/components/UI/PasswordField'
  import ErrorBag from "../../../helpers/ErrorBag"
  import ImageInput from "@/components/ImageInput/index"
  import swal from 'sweetalert'
  import UserService from "../../../services/UserService"
  import ClientService from "../../../services/ClientService"

  export default {
    name: 'CreateUsers',
    meta: {
      title: $t('pages.createUsers')
    },
    components: {
      ImageInput,
      ErrorList,
      PasswordField
    },
    data: () => ({errors: new ErrorBag()}),
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const formData = new FormData(ev.target)
        swal({
          title: $t('notifications.title.wait'),
          text: $t('notifications.message.user.create.wait'),
          icon: 'warning',
          buttons: {
            cancel: 'Cancelar',
            ok: {
              text: 'OK',
              value: true,
              closeModal: false
            }
          }
        })
          .then((shouldCreate) => {
            if (shouldCreate) return UserService.create(formData)
            return Promise.reject(false)
          })
          .then(response => {
            return response.data.data
          })
          .then(({id}) => {
            return ClientService.create(id)
          })
          .then(() => {
            return swal($t('notifications.title.success'), $t('notifications.message.user.create.success'), 'success')
          })
          .then(() => {
            this.$router.push({
              name: 'users'
            })
          })
          .catch(e => {
            if (e === false) {
              swal.stopLoading()
              swal.close()
            } else if (e && e.response && e.response.status === 422) {
              return swal($t('notifications.title.error'), $t('notifications.message.validation'), 'warning')
                .then(() => {
                  this.$data.errors = new ErrorBag(e.response.data.errors)

                  swal.stopLoading()
                  swal.close()
                })
            } else {
              unknownError()
            }
          })

        return false
      }
    }
  }
</script>

<template>
    <page>
        <h1>{{ $t('pages.createUsers') }}</h1>
        <div class="card shadow">
            <div class="card-body">
                <form @submit="onSubmit">
                    <div class="row">
                        <div class="col-12">
                            <error-list :errors="$data.errors.get('general')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.name') }}</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       :placeholder="$t('placeholders.name')">
                                <error-list :errors="$data.errors.get('name')"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.email') }}</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       :placeholder="$t('placeholders.email')">
                                <error-list :errors="$data.errors.get('email')"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <password-field name="password"/>
                            <error-list :errors="$data.errors.get('password')"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <password-field :label="$t('labels.password_confirmation')"
                                            name="password_confirmation"
                                            :placeholder="$t('placeholders.password_confirmation')"/>
                            <error-list :errors="$data.errors.get('password_confirmation')"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.phone') }}</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       :placeholder="$t('placeholders.phone')">
                                <error-list :errors="$data.errors.get('phone')"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <image-input name="image" :src="$imageHolder.buildUrl()"
                                         imgStyle="max-width: 200px; max-height: 200px">{{ $t('labels.image') }}
                            </image-input>
                            <error-list :errors="$data.errors.get('image')"/>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link :to="{name: 'users'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>