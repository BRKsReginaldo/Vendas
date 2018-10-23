<script>
    import dataTable from '@/mixins/dataTable'
    import withUser from '@/mixins/withUser'
    import swal from 'sweetalert'
    import ProviderService from "../../../services/ProviderService"

    export default {
      name: 'ListProviders',
      meta: {
        title: $t('pages.providers')
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
        dropProvider(provider) {
          swal({
            icon: 'warning',
            title: $t('notifications.title.confirm'),
            text: $t('notifications.message.provider.delete.confirm'),
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
              if (drop) return ProviderService.delete(provider)
              return Promise.reject(false)
            })
            .then(response => {
              return swal($t('notifications.title.success'), $t('notifications.message.provider.delete.success'), 'success')
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
            <div class="col-12 col-sm-4 col-md-6">
                <h1>{{ $t('pages.providers') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-sm-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedProviders'}" class="btn btn-info mr-2">Fornecedores Apagados</router-link>
                <router-link :to="{name: 'createProviders'}" class="btn btn-primary ">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <vue-table
                        ref="vuetable"
                        api-url="/api/providers"
                        :fields="fields"
                        data-path="data"
                        :http-options="requestAuth"
                        pagination-path="meta"
                        :css="css.table"
                        :no-data-template="$t('placeholders.noData')"
                >
                    <div slot="actions-slot" slot-scope="{rowData: props}">
                        <button class="btn btn-danger mr-2"
                                @click="dropProvider(props)"
                        >Apagar
                        </button>
                        <router-link class="btn btn-primary"
                                     :to="{'name':'editProviders', params: {id: props.id}}">
                            Editar
                        </router-link>
                    </div>
                </vue-table>
            </div>
        </div>
    </page>
</template>