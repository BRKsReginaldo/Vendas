<script>
  import PaymentTypeService from "../../../services/PaymentTypeService"
  import List from '@/components/UI/List'
  import {maxLength} from "../../../helpers/strings"

  export default {
    name: 'TrashedPaymentTypes',
    meta: {
      title: $t('pages.trashedPaymentTypes')
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
        },
        {
          name: 'observations',
          title: $t('labels.observations'),
          formatter: value => maxLength(75)('...')(value).replace(/\n/g, '<br/>')
        }
      ]
    }),
    methods: {
      restore(paymentType) {
        this.$mutate('restorePaymentType', {
          paymentType,
          onSuccess: () => this.$refs.vuetable.reload()
        })
      }
    }
  }
</script>

<template>
    <page>
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>{{ $t('pages.trashedPaymentTypes') }}</h1>
            </div>
            <div class="col-12 col-xl-4 text-center text-md-right mb-2 mb-xl-0">
                <router-link :to="{name: 'paymentTypes'}" class="btn btn-info mr-2">Métodos de Pagamentos</router-link>
                <router-link :to="{name: 'createPaymentTypes'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/payment-types/trashed"
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