import {commonMutation} from "../helpers/mutations"
import ClientService from "../services/ClientService"

export default ({clientId, onSuccess}) => {
  return commonMutation({
    successText: $t('notifications.message.client.enable.success'),
    confirmText: $t('notifications.message.client.enable.confirm'),
    mutate: () => ClientService.enable(clientId),
    onSuccess,
    setValidationErrors: () => null,
    dangerMode: true
  })
}