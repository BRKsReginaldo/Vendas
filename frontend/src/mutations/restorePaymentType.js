import {commonMutation} from "../helpers/mutations"
import PaymentTypeService from "../services/PaymentTypeService"

export default ({paymentType, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.paymentType.restore.success'),
    confirmText: $t('notifications.message.paymentType.restore.confirm'),
    mutate: () => PaymentTypeService.restore(paymentType),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}