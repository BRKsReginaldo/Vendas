<script>
  import ErrorBag from "../../../helpers/ErrorBag"
  import withUser from '@/mixins/withUser'
  import hasForm from '@/mixins/hasForm'
  import swal from 'sweetalert'
  import CustomerService from "../../../services/CustomerService"

  export default {
    name: 'CreateClients',
    mixins: [withUser, hasForm],
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const fd = new FormData(ev.target)
        fd.append('user_id', this.user.id)
        fd.append('client_id', this.user.client_id)

        swal({
          title: $t('notifications.title.wait'),
          text: $t('notifications.message.customer.create.wait'),
          icon: 'warning',
          buttons: {
            cancel: 'Cancelar',
            confirm: {
              text: 'OK',
              value: true,
              closeModal: false
            }
          }
        })
          .then(shouldCreate => {
            if (shouldCreate) return CustomerService.create(fd)
            return Promise.reject(false)
          })
          .then(res => res.data.data)
          .then(data => {
            return swal($t('notifications.title.success'), $t('notifications.message.customer.create.success'), 'success')
          })
          .then(() => {
            this.$router.push({
              name: 'uclientes'
            })
          })
          .catch(e => {
            if (e === false) {
              swal.close()
              swal.stopLoading()
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
        <div class="row">
            <div class="col-12">
                <h1>{{ $t('pages.createCustomers') }}</h1>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <form @submit="onSubmit">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.name') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       :placeholder="$t('placeholders.name')">
                                <error-list :errors="$data.errors.get('name')"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.phone')}}</label>
                                <input type="text"
                                       class="form-control"
                                       name="phone"
                                       :placeholder="$t('placeholders.phone')">
                                <error-list :errors="$data.errors.get('phone')"/>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link :to="{name: 'uclientes'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>