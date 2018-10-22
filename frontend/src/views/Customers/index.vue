<script>
  import dataTable from '@/mixins/dataTable'
  import withUser from '@/mixins/withUser'
  import CustomerService from "../../services/CustomerService"

  export default {
    name: 'Customers',
    meta: {
      title: $t('pages.customers')
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
          name: 'phone',
          sortField: 'phone',
          title: $t('labels.phone')
        },
        {
          name: 'actions-slot',
          title: $t('labels.actions')
        }
      ]
    }),
    methods: {
      dropCustomer(customer) {
        swal({
          icon: 'warning',
          title: $t('notifications.title.confirm'),
          text: $t('notifications.message.customer.delete.confirm'),
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
            if (drop) return CustomerService.delete(customer)
            return Promise.reject(false)
          })
          .then(response => {
            return swal($t('notifications.title.success'), $t('notifications.message.customer.delete.success'), 'success')
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
            <div class="col-12 col-md-6">
                <h1>{{ $t('pages.customers') }}</h1>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'uclientesApagados'}" class="btn btn-info mr-2">Clientes Apagados</router-link>
                <router-link :to="{name: 'cadastrarUClientes'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <vue-table
                        ref="vuetable"
                        api-url="/api/customers"
                        :fields="fields"
                        data-path="data"
                        :http-options="requestAuth"
                        pagination-path="meta"
                        :css="css.table"
                        :no-data-template="$t('placeholders.noData')"
                >
                    <div slot="actions-slot" slot-scope="{rowData: props}">
                        <button class="btn btn-danger"
                                @click="dropCustomer(props)"
                        >Apagar
                        </button>
                    </div>
                </vue-table>
            </div>
        </div>
    </page>
</template>