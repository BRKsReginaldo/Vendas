<script>
  import List from '@/components/UI/List'
  import {toMoney} from "../../../helpers/strings"

  export default {
    name: 'ListBuys',
    meta: {
      title: $t('pages.productsPurcharged')
    },
    components: {
      List,
    },
    data: () => ({
      count: 0,
      fields: [
        {
          name: 'image_small',
          title: $t('labels.image'),
        },
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'stock',
          title: $t('labels.stock'),
        },
      ]
    }),
    methods: {
    }
  }
</script>

<template>
    <page>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-6">
                <h1>{{ $t('pages.products') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-sm-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedProducts'}" class="btn btn-info mr-2 mb-2">{{ $t('pages.trashedProducts') }}
                </router-link>
                <router-link :to="{name: 'createProducts'}" class="btn btn-primary mb-2">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        has-actions
                        :fields="fields"
                        ref="vuetable"
                        :slots="['image_small']"
                        url="/api/products">
                    <template slot="image_small-slot" slot-scope="{rowData: props}">
                        <lightbox :src="props.image" :caption="props.name" album="products">
                            <img :src="props.image_small" :alt="props.name">
                        </lightbox>
                    </template>
                    <template slot="actions" slot-scope="{rowData: props}">
                        <router-link class="btn btn-primary"
                                     :to="{'name':'editProducts', params: {id: props.id}}">
                            Editar
                        </router-link>
                    </template>
                </list>
            </div>
        </div>
    </page>
</template>