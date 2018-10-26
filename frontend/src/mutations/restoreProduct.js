import {commonMutation} from "../helpers/mutations"
import ProductService from "../services/ProductService"

export default ({product, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.product.restore.success'),
    confirmText: $t('notifications.message.product.restore.confirm'),
    mutate: () => ProductService.restore(product),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}