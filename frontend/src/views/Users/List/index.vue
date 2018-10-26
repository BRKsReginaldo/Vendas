<script>
  import swal from 'sweetalert'
  import UserService from "../../../services/UserService"
  import List from '@/components/UI/List'

  export default {
    name: 'Users',
    components: {
      List
    },
    meta: {
      title: $t('pages.users')
    },
    data: () => ({
      fields: [
        {
          name: 'name',
          sortField: 'name',
          title: $t('labels.name'),
        },
        {
          name: 'email',
          sortField: 'email',
          title: $t('labels.email')
        },
        {
          name: 'phone',
          sortField: 'phone',
          title: $t('labels.phone')
        },
      ]
    }),
    methods: {
      dropUser(user) {
        this.$mutate('deleteUser', {
          user,
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
                <h1>{{ $t('pages.users') }}</h1>
            </div>
            <div class="col-12 col-sm-8 col-md-6 text-center text-md-right mb-2 mb-md-0">
                <router-link :to="{name: 'trashedUsers'}" class="btn btn-info mr-2">Usuários Apagados</router-link>
                <router-link :to="{name: 'createUsers'}" class="btn btn-primary mr-2">Cadastrar</router-link>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <list
                        ref="vuetable"
                        has-actions
                        url="/api/users"
                        :fields="fields">
                    <div slot="actions" slot-scope="{rowData: props}">
                        <button class="btn btn-danger"
                                @click="dropUser(props)"
                        >Apagar
                        </button>
                    </div>
                </list>
            </div>
        </div>
    </page>
</template>