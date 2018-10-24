import {commonMutation} from "../helpers/mutations"
import UserService from "../services/UserService"

export default ({user, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.user.restore.success'),
    confirmText: $t('notifications.message.user.restore.confirm'),
    mutate: () => UserService.restore(user),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}