<script>
  import withUser from '@/mixins/withUser'
  import hasForm from '@/mixins/hasForm'

  export default {
    name: 'CreateClients',
    mixins: [withUser, hasForm],
    data: () => ({
      phone: ''
    }),
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const data = new FormData(ev.target)

        this.$mutate('createCustomer', {
          data,
          user_id: this.user.id,
          phone: this.$data.phone,
          client_id: this.user.client_id,
          setErrors: this.setErrors,
          onSuccess: () => this.$router.push({
            name: 'customers'
          })
        })

        return false
      }
    }
  }
</script>

<template>
    <page>
        <div class="row">
            <div class="col-12">
                <h1>{{ $t('pages.createCustomers') }}</h1>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <form @submit="onSubmit">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.name') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       :placeholder="$t('placeholders.name')">
                                <error-list :errors="$data.errors.get('name')"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ $t('labels.phone')}}</label>
                                <the-mask
                                        :mask="['(##) ####-####', '(##) #####-####']"
                                        type="tel"
                                        class="form-control"
                                        v-model="phone"
                                        :placeholder="$t('placeholders.phone')"/>
                                <error-list :errors="$data.errors.get('phone')"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ $t('labels.observations') }}</label>
                                <textarea-autosize
                                        type="text"
                                        class="form-control"
                                        :min-height="75"
                                        :placeholder="$t('placeholders.observations')"
                                        name="observations"/>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link :to="{name: 'customers'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>