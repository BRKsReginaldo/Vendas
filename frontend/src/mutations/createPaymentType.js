import {commonMutation} from '../helpers/mutations'
import ProviderService from "../services/ProviderService"
import PaymentTypeService from "../services/PaymentTypeService"

export default ({data, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.paymentType.create.success'),
    confirmText: $t('notifications.message.paymentType.create.wait'),
    mutate: () => PaymentTypeService.create(data),
    onSuccess,
    setValidationErrors: setErrors
  })
}