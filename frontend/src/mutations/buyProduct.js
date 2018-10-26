import {commonMutation} from '../helpers/mutations'
import ProductBuyService from "../services/ProductBuyService"

export default ({data, user_id, client_id, product, amount, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)
  data.append('product_id', product ? product.id : null)
  data.append('amount', amount)

  return commonMutation({
    successText: $t('notifications.message.product.buy.success'),
    confirmText: $t('notifications.message.product.buy.confirm'),
    mutate: () => ProductBuyService.buy(data, product),
    onSuccess,
    setValidationErrors: setErrors
  })
}