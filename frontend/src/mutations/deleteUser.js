import {commonMutation} from "../helpers/mutations"
import UserService from "../services/UserService"

export default ({user, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.user.delete.success'),
    confirmText: $t('notifications.message.user.delete.confirm'),
    mutate: () => UserService.delete(user),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}