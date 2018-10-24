import {commonMutation} from "../helpers/mutations"
import ProviderService from "../services/ProviderService"

export default ({provider, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.provider.delete.success'),
    confirmText: $t('notifications.message.provider.delete.confirm'),
    mutate: () => ProviderService.delete(provider),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}