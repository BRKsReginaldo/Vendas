<script>
  import withUser from '@/mixins/withUser'
  import hasForm from '@/mixins/hasForm'
  import ImageInput from "@/components/ImageInput"
  import SelectInput from '@/components/SelectInput'

  export default {
    name: 'CreateProducts',
    components: {ImageInput, SelectInput},
    mixins: [withUser, hasForm],
    meta: {
      title: $t('pages.createProducts')
    },
    data: () => ({
      buy_price: 0,
      sell_price: 0,
      provider: null
    }),
    methods: {
      onSubmit(ev) {
        ev.preventDefault()

        const data = new FormData(ev.target)
        const provider = this.$data.provider

        this.$mutate('createProduct', {
          data,
          provider,
          client_id: this.user.client_id,
          user_id: this.user.id,
          buy_price: this.buy_price,
          sell_price: this.sell_price,
          setErrors: this.setErrors,
          onSuccess: () => this.$router.push({
            name: 'products'
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
                <h1>{{ $t('pages.createProducts') }}</h1>
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
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>{{ $t('labels.buy_price') }}</label>
                                <money v-model="buy_price" class="form-control"/>
                                <error-list :errors="$data.errors.get('buy_price')"/>

                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>{{ $t('labels.sell_price') }}</label>
                                <money v-model="sell_price" class="form-control"/>
                                <error-list :errors="$data.errors.get('sell_price')"/>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <select-input
                                    label-key="name"
                                    v-model="provider"
                                    :placeholder="$t('placeholders.provider')"
                                    url="/api/providers">
                                {{ $t('labels.provider') }}
                            </select-input>
                            <error-list :errors="$data.errors.get('provider_id')"/>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ $t('labels.description') }}</label>
                                <textarea-autosize
                                        type="text"
                                        class="form-control"
                                        :min-height="75"
                                        :placeholder="$t('placeholders.description')"
                                        name="description"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <image-input src="" name="image" imgStyle="max-width: 200px; max-height: 300px">
                                {{ $t('labels.image') }}
                            </image-input>
                            <error-list :errors="$data.errors.get('image')"/>
                        </div>
                    </div>
                    <div class="text-right">
                        <router-link :to="{name: 'products'}" class="btn btn-danger mr-2">Cancelar</router-link>
                        <button class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>