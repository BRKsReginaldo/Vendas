import CustomerService from "../services/CustomerService"
import {commonMutation} from "../helpers/mutations"

export default ({customer, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.customer.delete.success'),
    confirmText: $t('notifications.message.customer.delete.confirm'),
    mutate: () => CustomerService.delete(customer),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}