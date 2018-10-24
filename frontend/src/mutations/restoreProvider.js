import {commonMutation} from "../helpers/mutations"
import ProviderService from "../services/ProviderService"

export default ({provider, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.provider.restore.success'),
    confirmText: $t('notifications.message.provider.restore.confirm'),
    mutate: () => ProviderService.restore(provider),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}