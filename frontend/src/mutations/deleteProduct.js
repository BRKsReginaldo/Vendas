import {commonMutation} from "../helpers/mutations"
import ProductService from "../services/ProductService"

export default ({product, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.product.delete.success'),
    confirmText: $t('notifications.message.product.delete.confirm'),
    mutate: () => ProductService.delete(product),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}