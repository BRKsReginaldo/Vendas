<script>
  import ErrorBag from "../../../helpers/ErrorBag"
  import withUser from '@/mixins/withUser'
  import hasForm from '@/mixins/hasForm'
  import swal from 'sweetalert'
  import PaymentTypeService from "../../../services/PaymentTypeService"

  export default {
    name: 'EditPaymentTypes',
    mixins: [withUser, hasForm],
    data: () => ({name: '', paymentType: null}),
    mounted() {
        PaymentTypeService.show(this.$route.params.id)
          .then(({data: {data}}) => {
            this.$data.paymentType = data
            this.$data.name = data.name
          })
    },
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const data = new FormData(ev.target)

        this.mutate('editPaymentType', {
          data,
          paymentType: this.$data.paymentType,
          client_id: this.user.client_id,
          user_id: this.user.id,
          setErrors: errors => this.$data.errors = errors,
          onSuccess: () => this.$router.push({
            name: 'paymentTypes'
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
                <h1>{{ $t('pages.editPaymentTypes') }}</h1>
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
                                       :value="name"
                                       :placeholder="$t('placeholders.name')">
                                <error-list :errors="$data.errors.get('name')"/>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link :to="{name: 'paymentTypes'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>