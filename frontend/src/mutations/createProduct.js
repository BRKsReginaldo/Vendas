import {commonMutation} from '../helpers/mutations'
import ProductService from "../services/ProductService"

export default ({data, user_id, client_id,buy_price, sell_price, provider, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)
  data.append('buy_price', buy_price)
  data.append('sell_price', sell_price)
  data.append('provider_id', provider ? provider.id : null)

  return commonMutation({
    successText: $t('notifications.message.product.create.success'),
    confirmText: $t('notifications.message.product.create.wait'),
    mutate: () => ProductService.create(data),
    onSuccess,
    setValidationErrors: setErrors
  })
}