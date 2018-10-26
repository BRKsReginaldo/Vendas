import {commonMutation} from '../helpers/mutations'
import UserService from "../services/UserService"
import ClientService from "../services/ClientService"


export default ({data, setErrors, onSuccess}) => {

  return commonMutation({
    successText: $t('notifications.message.user.create.success'),
    confirmText: $t('notifications.message.user.create.wait'),
    mutate: () => UserService.create(data),
    beforeSuccess: response => ClientService.create(response.data.data.id),
    onSuccess,
    setValidationErrors: setErrors
  })
}