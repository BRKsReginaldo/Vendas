import {commonMutation} from "../helpers/mutations"
import PaymentTypeService from "../services/PaymentTypeService"

export default ({paymentType, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.paymentType.delete.success'),
    confirmText: $t('notifications.message.paymentType.delete.confirm'),
    mutate: () => PaymentTypeService.delete(paymentType),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}