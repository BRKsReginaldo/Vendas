import {commonMutation} from '../helpers/mutations'
import ProviderService from "../services/ProviderService"

export default ({data, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.provider.create.success'),
    confirmText: $t('notifications.message.provider.create.wait'),
    mutate: () => ProviderService.create(data),
    onSuccess,
    setValidationErrors: setErrors
  })
}