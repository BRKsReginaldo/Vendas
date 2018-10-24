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
      title: $t('pages.trashedUsers')
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
        }
      ]
    }),
    methods: {
      restore(id) {
        swal({
          icon: 'warning',
          title: $t('notifications.title.confirm'),
          text: $t('notifications.message.user.restore.confirm'),
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
            if (drop) return UserService.restore(id)
            return Promise.reject(false)
          })
          .then(response => {
            return swal($t('notifications.title.success'), $t('notifications.message.user.restore.success'), 'success')
          })
          .then(() => {
            this.$refs.vuetable.reload()
          })
          .catch(e => {
            swal.close()
            swal.stopLoading()
            if (e) {
              console.log(e)
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
            <div class="col-12 col-sm-8 col-md-6">
                <h1>{{ $t('pages.trashedUsers') }}</h1>
            </div>
            <div class="col-12 col-sm-4 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'users'}" class="btn btn-info mr-2">Usuários</router-link>
                <router-link :to="{name: 'createUsers'}" class="btn btn-primary ">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/users/trashed"
                        has-actions
                        :fields="fields">
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-success"
                                @click="restore(props.id)"
                        >Restaurar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>