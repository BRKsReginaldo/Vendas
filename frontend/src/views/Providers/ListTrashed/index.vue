<script>
  import dataTable from '@/mixins/dataTable'
  import withUser from '@/mixins/withUser'
  import CustomerService from "../../../services/CustomerService"
  import ProviderService from "../../../services/ProviderService"

  export default {
    name: 'TrashedProviders',
    meta: {
      title: $t('pages.trashedProviders')
    },
    mixins: [dataTable, withUser],
    data: () => ({
      fields: [
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'actions-slot',
          title: $t('labels.actions')
        }
      ]
    }),
    methods: {
      restore(provider) {
        swal({
          icon: 'warning',
          title: $t('notifications.title.confirm'),
          text: $t('notifications.message.provider.restore.confirm'),
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
            if (drop) return ProviderService.restore(provider)
            return Promise.reject(false)
          })
          .then(response => {
            return swal($t('notifications.title.success'), $t('notifications.message.provider.restore.success'), 'success')
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
            <div class="col-sm-12 col-md-8">
                <h1>{{ $t('pages.trashedProviders') }}</h1>
            </div>
            <div class="col-sm-12 col-md-4 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'providers'}" class="btn btn-info mr-2">Clientes</router-link>
                <router-link :to="{name: 'createCustomers'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <vue-table
                        ref="vuetable"
                        api-url="/api/providers/trashed"
                        :fields="fields"
                        data-path="data"
                        :http-options="requestAuth"
                        pagination-path="meta"
                        :css="css.table"
                        :no-data-template="$t('placeholders.noData')"
                >
                    <div slot="actions-slot" slot-scope="{rowData: props}">
                        <button class="btn btn-success"
                                @click="restore(props)"
                        >Restaurar
                        </button>
                    </div>
                </vue-table>
            </div>
        </div>
    </page>
</template>