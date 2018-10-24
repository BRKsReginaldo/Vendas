import CustomerService from "../services/CustomerService"
import {commonMutation} from "../helpers/mutations"

export default ({data, customer, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.customer.edit.success'),
    confirmText: $t('notifications.message.customer.edit.wait'),
    mutate: () => CustomerService.update(customer, data),
    onSuccess,
    setValidationErrors: setErrors
  })
}