import {commonMutation} from "../helpers/mutations"
import ClientService from "../services/ClientService"

export default ({clientId, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.client.disable.success'),
    confirmText: $t('notifications.message.client.disable.confirm'),
    mutate: () => ClientService.disable(clientId),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}