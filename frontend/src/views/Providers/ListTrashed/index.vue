<script>
  import ProviderService from "../../../services/ProviderService"
  import List from '@/components/UI/List'

  export default {
    name: 'TrashedProviders',
    meta: {
      title: $t('pages.trashedProviders')
    },
    components: {
      List
    },
    data: () => ({
      fields: [
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        }
      ]
    }),
    methods: {
      restore(provider) {
        this.mutate('restoreProvider', {
          provider,
          onSuccess: () => this.$refs.vuetable.reload()
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
                <router-link :to="{name: 'createPaymentTypes'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/providers/trashed"
                        has-actions
                        :fields="fields"
                >
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-success"
                                @click="restore(props)"
                        >Restaurar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>