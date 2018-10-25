<script>
    import swal from 'sweetalert'
    import PaymentTypeService from "../../../services/PaymentTypeService"
    import List from '@/components/UI/List'
    import {maxLength} from "../../../helpers/strings"

    export default {
      name: 'ListPaymentTypes',
      meta: {
        title: $t('pages.paymentTypes')
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
            formatter: value => maxLength(75)('...')(value).replace(/\n/g, '<br/>')
          }
        ]
      }),
      methods: {
        dropPaymentType(paymentType) {
          this.$mutate('deletePaymentType', {
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
            <div class="col-12 col-xl-5">
                <h1>{{ $t('pages.paymentTypes') }}</h1>
            </div>
            <div class="col-12  col-xl-7 text-center text-sm-right mb-2 mb-xl-0">
                <router-link :to="{name: 'trashedPaymentTypes'}" class="btn btn-info mr-2">Métodos de Pagamentos Apagados</router-link>
                <router-link :to="{name: 'createPaymentTypes'}" class="btn btn-primary ">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                    has-actions
                    :fields="fields"
                    ref="vuetable"
                    url="/api/payment-types">
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-danger mr-2"
                                @click="dropPaymentType(props)"
                        >Apagar
                        </button>
                        <router-link class="btn btn-primary"
                                     :to="{'name':'editPaymentTypes', params: {id: props.id}}">
                            Editar
                        </router-link>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>