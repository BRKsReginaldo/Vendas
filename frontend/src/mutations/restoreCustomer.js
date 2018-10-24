import CustomerService from "../services/CustomerService"
import {commonMutation} from "../helpers/mutations"

export default ({customer, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.customer.restore.success'),
    confirmText: $t('notifications.message.customer.restore.confirm'),
    mutate: () => CustomerService.restore(customer),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}