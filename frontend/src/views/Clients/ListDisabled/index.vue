<script>
  import swal from 'sweetalert'
  import ClientService from "../../../services/ClientService"
  import List from '@/components/UI/List'

  export default {
    name: 'DisabledClientes',
    components: {
      List
    },
    meta: {
      title: $t('pages.disabledClients')
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
      enable(clientId) {
        this.$mutate('enableClient', {
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
            <div class="col-12 col-sm-8 col-md-6">
                <h1>{{ $t('pages.disabledClients') }}</h1>
            </div>
            <div class="col-12 col-sm-4 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'clients'}" class="btn btn-info">Clientes</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/clients/disabled"
                        :fields="fields"
                        has-actions
                >
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-primary"
                                @click="enable(props.id)"
                        >Ativar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>