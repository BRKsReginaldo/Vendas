import {commonMutation} from "../helpers/mutations"
import PaymentTypeService from "../services/PaymentTypeService"

export default ({data, paymentType, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.paymentType.edit.success'),
    confirmText: $t('notifications.message.paymentType.edit.wait'),
    mutate: () => PaymentTypeService.update(paymentType, data),
    onSuccess,
    setValidationErrors: setErrors
  })
}