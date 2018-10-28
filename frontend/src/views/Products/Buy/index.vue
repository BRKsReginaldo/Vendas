<script>
  import SelectInput from "@/components/SelectInput/index"
  import CreatePayment from '@/components/CreatePayment'
  import ErrorBag from "../../../helpers/ErrorBag"
  import hasForm from '@/mixins/hasForm'
  import withUser from '@/mixins/withUser'

  export default {
    name: 'BuyProduct',
    mixins: [hasForm, withUser],
    components: {SelectInput, CreatePayment},
    meta: {
      title: $t('pages.buyProduct')
    },
    data: () => ({
      product: null,
      errors: new ErrorBag(),
      amount: null,
      productBuyId: null
    }),
    computed: {
      original_price() {
        return this.product ? (this.product.sell_price * this.amount) : 0
      }
    },
    methods: {
      buy(ev) {
        let onSuccess = () => this.$router.push({
          name: 'products',
        })

        if (this.$data.productBuyId) {
          this.$refs.payment.create(this.$data.productBuyId)
            .then(onSuccess)
        }

        const data = new FormData(ev.target)

        this.$mutate('buyProduct', {
          data,
          amount: this.amount,
          product: this.product,
          client_id: this.user.client_id,
          user_id: this.user.id,
          setErrors: this.setErrors,
          beforeSuccess: async (res) => {
            this.$data.productBuyId = res.data.data.id
            return this.$refs.payment.create(res.data.data.id)
          },
          onSuccess
        })

      }
    }
  }
</script>

<template>
    <page>
        <div class="card shadow">
            <div class="card-body">
                <form @submit.prevent="buy">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ $t('labels.product') }}</label>
                            <select-input
                                    label-key="name"
                                    url="/api/products"
                                    v-model="product"
                                    custom-option
                                    :placeholders="$t('placeholders.product')">
                                <template slot="option" slot-scope="{option}">
                                    <img
                                            style="max-width: 25px; max-height: 25px"
                                            class="mr-2"
                                            :src="option.image_small"
                                            :alt="option.name">
                                    <span>{{ option.name }}</span>
                                </template>
                            </select-input>
                            <error-list :errors="$data.errors.get('product_id')"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ $t('labels.amount') }}</label>
                            <the-mask
                                    mask="#########"
                                    :placeholder="$t('placeholders.amount')"
                                    type="tel"
                                    v-model="amount"
                                    style="height: 43px"
                                    class="form-control"/>
                            <error-list :errors="$data.errors.get('amount')"/>
                        </div>
                    </div>
                    <create-payment
                            ref="payment"
                            payable-type="App\ProductBuy"
                            :original-price="original_price" shown/>
                    <div class="text-right">
                        <router-link to="/"
                                     class="btn btn-danger mr-2">Cancelar
                        </router-link>
                        <button class="btn btn-primary">Comprar</button>
                    </div>
                </form>
            </div>
        </div>
    </page>
</template>