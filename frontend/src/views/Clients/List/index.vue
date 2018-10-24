<script>
  import swal from 'sweetalert'
  import ClientService from "../../../services/ClientService"
  import List from '@/components/UI/List'

  export default {
    name: 'Clients',
    meta: {
      title: $t('pages.clients')
    },
    components: {
      List
    },
    data: () => ({
      fields: [
        {
          name: 'id',
          sortField: 'id',
          title: $t('labels.id'),
        },
        {
          name: 'creator.name',
          title: $t('labels.creator')
        }
      ]
    }),
    methods: {
      disable(clientId) {
        this.mutate('disableClient', {
          clientId,
          onSuccess: () => this.$refs.vuetable.reload()
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
                <router-link :to="{name: 'disabledClients'}" class="btn btn-info">Clientes Desativados</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/clients"
                        :fields="fields"
                        has-actions
                >
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-danger"
                                @click="disable(props.id)"
                        >Desativar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>