import {commonMutation} from "../helpers/mutations"
import ProviderService from "../services/ProviderService"

export default ({data, provider, user_id, client_id, setErrors, onSuccess}) => {
  data.append('client_id', client_id)
  data.append('user_id', user_id)

  return commonMutation({
    successText: $t('notifications.message.provider.edit.success'),
    confirmText: $t('notifications.message.provider.edit.wait'),
    mutate: () => ProviderService.update(provider, data),
    onSuccess,
    setValidationErrors: setErrors
  })
}