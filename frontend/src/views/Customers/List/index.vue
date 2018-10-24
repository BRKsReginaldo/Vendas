<script>
  import List from '@/components/UI/List'
  import {maxLength} from "../../../helpers/strings"

  export default {
    name: 'Customers',
    meta: {
      title: $t('pages.customers')
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
          formatter(value) {
            return maxLength(75, '...')(value).replace(/\n/g, '<br/>')
          }
        }
      ]
    }),
    methods: {
      dropCustomer(customer) {
        this.mutate('deleteCustomer', {
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
                <h1>{{ $t('pages.customers') }}</h1>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedCustomers'}" class="btn btn-info mr-2">Clientes Apagados</router-link>
                <router-link :to="{name: 'createCustomers'}" class="btn btn-primary">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        url="/api/customers"
                        :fields="fields"
                        has-actions>
                    <div
                            slot="actions"
                            slot-scope="{rowData: props}">
                        <button class="btn btn-danger mr-2"
                                @click="dropCustomer(props)"
                        >Apagar
                        </button>
                        <router-link class="btn btn-primary"
                                     :to="{'name':'editCustomers', params: {id: props.id}}">
                            Editar
                        </router-link>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>