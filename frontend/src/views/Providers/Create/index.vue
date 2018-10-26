<script>
  import ErrorBag from "../../../helpers/ErrorBag"
  import withUser from '@/mixins/withUser'
  import hasForm from '@/mixins/hasForm'
  import swal from 'sweetalert'
  import ProviderService from "../../../services/ProviderService"

  export default {
    name: 'CreateProviders',
    mixins: [withUser, hasForm],
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const data = new FormData(ev.target)

        this.$mutate('createProvider', {
          data,
          client_id: this.user.client_id,
          user_id: this.user.id,
          setErrors: this.setErrors,
          onSuccess: () => this.$router.push({
            name: 'providers'
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
                <h1>{{ $t('pages.createProviders') }}</h1>
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
                        <router-link :to="{name: 'providers'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>