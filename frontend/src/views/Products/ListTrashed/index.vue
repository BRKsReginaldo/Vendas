<script>
  import ProviderService from "../../../services/ProviderService"
  import List from '@/components/UI/List'
  import {maxLength} from "../../../helpers/strings"

  export default {
    name: 'TrashedProducts',
    meta: {
      title: $t('pages.trashedProducts')
    },
    components: {
      List
    },
    data: () => ({
      fields: [
        {
          name: 'image_small',
          title: $t('labels.image'),
          formatter: src => `<img src="${src}"/>`
        },
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'description',
          title: $t('labels.description'),
          formatter: value => maxLength(50, '...', value).replace(/\n/g, '<br/>')
        }
      ]
    }),
    methods: {
      restore(product) {
        this.$mutate('restoreProduct', {
          product,
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
                <h1>{{ $t('pages.trashedProducts') }}</h1>
            </div>
            <div class="col-sm-12 col-md-4 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'products'}" class="btn btn-info mr-2">{{ $t('pages.products') }}</router-link>
                <router-link :to="{name: 'createProducts'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/products/trashed"
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