<script>
  import swal from 'sweetalert'
  import UserService from "../../../services/UserService"
  import List from '@/components/UI/List'

  export default {
    name: 'Users',
    components: {
      List
    },
    meta: {
      title: $t('pages.users')
    },
    data: () => ({
      fields: [
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'email',
          sortField: 'email',
          title: $t('labels.email')
        },
        {
          name: 'phone',
          sortField: 'phone',
          title: $t('labels.phone')
        },
      ]
    }),
    methods: {
      dropUser(id) {
        swal({
          icon: 'warning',
          title: $t('notifications.title.confirm'),
          text: $t('notifications.message.user.delete.confirm'),
          buttons: {
            cancel: 'Cancelar',
            confirm: {
              text: 'Confirmar',
              value: true,
              closeModal: false
            }
          },
          dangerMode: true
        })
          .then(drop => {
            if (drop) return UserService.delete(id)
            return Promise.reject(false)
          })
          .then(response => {
            return swal($t('notifications.title.success'), $t('notifications.message.user.delete.success'), 'success')
          })
          .then(() => {
            this.$refs.vuetable.reload()
          })
          .catch(e => {
            swal.close()
            swal.stopLoading()
            if (e) {
              unknownError()
            }
          })
      }
    }
  }
</script>

<template>
    <page>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-6">
                <h1>{{ $t('pages.users') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedUsers'}" class="btn btn-info mr-2">Usuários Apagados</router-link>
                <router-link :to="{name: 'createUsers'}" class="btn btn-primary mr-2">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        has-actions
                        url="/api/users"
                        :fields="fields">
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-danger"
                                @click="dropUser(props.id)"
                        >Apagar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>