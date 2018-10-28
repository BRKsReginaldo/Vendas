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
      withRelations: ['product', 'payment'],
      fields: [
        {
          name: 'image_small',
          title: $t('labels.image'),
        },
        {
          name: 'product.name',
          title: $t('labels.name'),
        },
        {
          name: 'amount',
          title: $t('labels.amount'),
        },
        {
          name: 'payment.paid',
          title: $t('labels.paid'),
          formatter: value => value ? 'Sim' : 'Não'
        },
        {
          name: 'created_at',
          title: $t('labels.buyed_at')
        },
        {
          name: 'payment.price',
          title: $t('labels.total'),
          formatter: value => 'R$ ' + toMoney(value || 0)
        }
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
                <h1>{{ $t('pages.productsPurcharged') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-sm-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedProducts'}" class="btn btn-info mr-2 mb-2">{{ $t('pages.trashedProducts') }}
                </router-link>
                <router-link :to="{name: 'buyProducts'}" class="btn btn-primary mb-2">{{ $t('pages.buyProducts') }}</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        has-actions
                        :fields="fields"
                        ref="vuetable"
                        :with="withRelations"
                        :slots="['image_small']"
                        url="/api/product-buys">
                    <template slot="image_small-slot" slot-scope="{rowData: props}">
                        <lightbox :src="props.image" :caption="props.name" album="products">
                            <img :src="props.product.image_small" :alt="props.product.name">
                        </lightbox>
                    </template>
                    <template slot="actions" slot-scope="{rowData: props}">
                       <template v-if="props.payment">
                           <router-link class="btn btn-primary"
                                        :to="{'name':'editProducts', params: {id: props.id}}">
                               Editar
                           </router-link>
                       </template>
                    </template>
                </list>
            </div>
        </div>
    </page>
</template>