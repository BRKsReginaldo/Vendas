<script>
  import VueTable from 'vuetable-2'
  import css from '@/config/tables'
  import swal from 'sweetalert'
  import UserService from "../../services/UserService"
  import withUser from '@/mixins/withUser'
  import ClientService from "../../services/ClientService"

  export default {
    name: 'Clients',
    components: {
      VueTable
    },
    mixins: [withUser],
    meta: {
      title: $t('pages.clients')
    },
    data: () => ({
      css,
      fields: [
        {
          name: 'id',
          sortField: 'id',
          title: $t('labels.id'),
        },
        {
          name: 'creator.name',
          title: $t('labels.creator')
        },
        {
          name: 'actions-slot',
          title: $t('labels.actions')
        }
      ]
    }),
    methods: {
      disable(id) {
        swal({
          icon: 'warning',
          title: $t('notifications.title.confirm'),
          text: $t('notifications.message.client.disable.confirm'),
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
            if (drop) return ClientService.disable(id)
            return Promise.reject(false)
          })
          .then(response => {
            return swal($t('notifications.title.success'), $t('notifications.message.client.disable.success'), 'success')
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
                <h1>{{ $t('pages.clients') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'clientesDesativados'}" class="btn btn-info">Clientes Desativados</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <vue-table
                        ref="vuetable"
                        api-url="/api/clients"
                        :fields="fields"
                        data-path="data"
                        :http-options="requestAuth"
                        pagination-path="meta"
                        :css="css.table"
                >
                    <div slot="actions-slot" slot-scope="{rowData: props}">
                        <button class="btn btn-danger"
                                @click="disable(props.id)"
                        >Desativar
                        </button>
                    </div>
                </vue-table>
            </div>
        </div>
    </page>
</template>