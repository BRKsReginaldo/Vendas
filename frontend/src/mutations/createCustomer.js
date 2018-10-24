import CustomerService from "../services/CustomerService"
import {commonMutation} from '../helpers/mutations'

export default ({data, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.customer.create.success'),
    confirmText: $t('notifications.message.customer.create.wait'),
    mutate: () => CustomerService.create(data),
    onSuccess,
    setValidationErrors: setErrors
  })
}