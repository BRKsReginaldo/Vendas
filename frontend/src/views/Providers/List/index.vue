<script>
  import swal from 'sweetalert'
  import ProviderService from "../../../services/ProviderService"
  import List from '@/components/UI/List'
  import {maxLength} from "../../../helpers/strings"

  export default {
    name: 'ListProviders',
    meta: {
      title: $t('pages.providers')
    },
    components: {
      List,
    },
    data: () => ({
      count: 0,
      fields: [
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'observations',
          title: $t('labels.observations'),
          formatter: value => maxLength(75, '...', value).replace(/\n/g, '<br/>')
        }
      ]
    }),
    methods: {
      dropProvider(provider) {
        this.$mutate('deleteProvider', {
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
            <div class="col-12 col-sm-4 col-md-6">
                <h1>{{ $t('pages.providers') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-sm-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedProviders'}" class="btn btn-info mr-2">Fornecedores Apagados
                </router-link>
                <router-link :to="{name: 'createProviders'}" class="btn btn-primary ">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        has-actions
                        :fields="fields"
                        ref="vuetable"
                        url="/api/providers">
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-danger mr-2"
                                @click="dropProvider(props)"
                        >Apagar
                        </button>
                        <router-link class="btn btn-primary"
                                     :to="{'name':'editProviders', params: {id: props.id}}">
                            Editar
                        </router-link>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>