<script>
  import Accordion from '@/components/UI/Accordion'
  import PaymentTypeService from "../../services/PaymentTypeService"
  import SelectInput from "../SelectInput/index"
  import withUser from '@/mixins/withUser'
  import PaymentService from "../../services/PaymentService"
  import hasForm from '@/mixins/hasForm'
  import ErrorList from "../UI/ErrorList/index"

  export default {
    name: 'CreatePayment',
    components: {
      ErrorList,
      SelectInput,
      Accordion,
    },
    mixins: [withUser, hasForm],
    props: {
      shown: {
        type: Boolean,
        default: () => false
      },
      label: {
        type: String,
        default: () => $t('labels.createPayment'),
      },
      originalPrice: {
        type: Number,
        default: () => 0
      },
      payableType: {
        type: String,
        required: true
      }
    },
    data: () => ({
      payment_type: null,
      total_plots: null,
      has_discount: false,
      discount_type: null,
      payed_at: null,
      discount: 0,
      paid: false
    }),
    computed: {
      total_price() {
        if (this.$data.has_discount && this.$data.discount !== 0) {
          const discount = this.$data.discount_type === 'percentage' ? this.$props.originalPrice * (this.$data.discount / 100) : this.$data.discount
          return this.$props.originalPrice - discount
        }
        return this.$props.originalPrice
      }
    },
    methods: {
      create(payable_id) {
        return PaymentService.create({
          client_id: this.user.client_id,
          original_price: this.$props.originalPrice,
          discount: this.discount,
          discount_percentage: this.discount_type === 'percentage',
          price: this.total_price,
          payment_type_id: this.payment_type ? this.payment_type.id : null,
          total_plots: this.total_plots  ? this.total_plots.value : 0,
          pending_plots: this.paid && this.total_plots ? 0 : this.total_plots ? this.total_plots.value : 0,
          paid_plots: this.paid && this.total_plots ? this.total_plots.value : 0,
          payed_at: this.paid ? this.payed_at : null,
          payable_type: this.$props.payableType,
          payable_id
        })
          .catch(e => {
            if (e.response.status === 422) {
              this.setErrors(e.response.data.errors)
            }
          })
      }
    }
  }
</script>

<template>
    <accordion :shown="$props.shown">
        <template slot="header">{{ $props.label }}</template>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ $t('labels.original_price') }}</label>
                    <money class="form-control bg-light" readonly :value="originalPrice"/>
                    <error-list :errors="$data.errors.get('original_price')"/>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <label class="form-control border-0">
                        <input type="checkbox" v-model="has_discount">
                        <span class="ml-2">Tem desconto ?</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row" v-show="has_discount">
            <div class="col-12 col-sm-7">
                <div class="form-group">
                    <label>{{ $t('labels.discount_type') }}</label>
                    <div class="form-control row border-0">
                        <label class="col-6">
                            <input type="radio" value="percentage" v-model="discount_type">
                            <span class="ml-2">Porcentagem</span>
                        </label>
                        <label class="col-6">
                            <input type="radio" value="value" v-model="discount_type">
                            <span class="ml-2">Valor</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5" v-show="discount_type !== null">
                <div class="form-group">
                    <label>{{ $t('labels.discount') }}</label>
                    <money prefix=""
                           :suffix="discount_type === 'percentage' ? '%' : ''"
                           :decimal="discount_type === 'value' ? ',' : '.'"
                           v-show="discount_type"
                           v-model="discount" class="form-control"/>
                    <error-list :errors="$data.errors.get('discount')"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>{{ $t('labels.total_price') }}</label>
                    <money class="form-control bg-light" :value="total_price" readonly/>
                    <error-list :errors="$data.errors.get('total_price')"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <select-input
                        label-key="name"
                        :show-labels="false"
                        v-model="payment_type"
                        url="/api/payment-types"
                        :placeholder="$t('placeholders.payment_type')">
                    {{ $t('labels.payment_type') }}
                </select-input>
                <error-list :errors="$data.errors.get('payment_type')"/>
            </div>
            <div class="col-12">
                <select-input
                        label-key="name"
                        value-key="value"
                        :show-labels="false"
                        v-model="total_plots"
                        url="/api/plots"
                        :placeholder="$t('placeholders.total_plots')">
                    {{ $t('labels.total_plots') }}
                </select-input>
                <error-list :errors="$data.errors.get('total_plots')"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <label class="form-control border-0">
                        <input type="checkbox" v-model="paid">
                        <span class="ml-2">Já foi pago ?</span>
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-6" v-show="paid">
                <div class="form-group">
                    <label>Quando ?</label>
                    <the-mask mask="##/##/####" masked v-model="payed_at" class="form-control" :placeholder="$t('placeholders.paid_at')"/>
                    <error-list :errors="$data.errors.get('payed_at')"/>
                </div>
            </div>
        </div>
    </accordion>
</template>