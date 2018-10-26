import {commonMutation} from "../helpers/mutations"
import ProductService from "../services/ProductService"

export default ({data, product, user_id, client_id, buy_price, sell_price, provider, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)
  data.append('buy_price', buy_price)
  data.append('sell_price', sell_price)
  data.append('provider_id', provider ? provider.id : null)

  return commonMutation({
    successText: $t('notifications.message.product.edit.success'),
    confirmText: $t('notifications.message.product.edit.wait'),
    mutate: () => ProductService.update(product, data),
    onSuccess,
    setValidationErrors: setErrors
  })
}