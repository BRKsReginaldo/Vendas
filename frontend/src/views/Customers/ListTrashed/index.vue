<script>
  import CustomerService from "../../../services/CustomerService"
  import List from '@/components/UI/List'
  import {maxLength} from "../../../helpers/strings"

  export default {
    name: 'Customers',
    meta: {
      title: $t('pages.trashedCustomers')
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
          name: 'phone',
          sortField: 'phone',
          title: $t('labels.phone')
        },
        {
          name: 'observations',
          title: $t('labels.observations'),
          formatter: value => maxLength(75)('...')(value).replace(/\n/g, '<br/>')
        }
      ]
    }),
    methods: {
      restore(customer) {
        this.mutate('restoreCustomer', {
          customer,
          onSuccess: () => this.$refs.vuetable.reload()
        })
      }
    }
  }
</script>

<template>
    <page>
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>{{ $t('pages.trashedCustomers') }}</h1>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'customers'}" class="btn btn-info mr-2">Clientes</router-link>
                <router-link :to="{name: 'createCustomers'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/customers/trashed"
                        :fields="fields"
                        has-actions
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