export const commonMutation = (
  {
    confirmTitle = $t('notifications.title.wait'),
    confirmType = 'warning',
    confirmText,
    successTitle = $t('notifications.title.success'),
    successType = 'success',
    successText,
    onSuccess = () => null,
    beforeSuccess,
    validationErrorTitle = $t('notifications.title.error'),
    validationErrorText = $t('notifications.message.error'),
    validationErrorType = 'error',
    setValidationErrors = () => null,
    mutate,
    dangerMode = false
  }) => {
  swal({
    title: confirmTitle,
    text: confirmText,
    icon: confirmType,
    buttons: {
      cancel: 'Cancelar',
      confirm: {
        text: 'OK',
        value: true,
        closeModal: false
      },
    },
    dangerMode
  })
    .then(shouldProceed => {
      if (shouldProceed) return mutate()
      return Promise.reject(false)
    })
    .then(response => {
      if (beforeSuccess) return beforeSuccess(response).then(() => response)
      return response
    })
    .then((response) => {
      return swal(successTitle, successText, successType)
        .then(() => response)
    })
    .then((response) => {
      onSuccess(response)
    })
    .catch(e => {
      if (e === false) {
        swal.close()
        swal.stopLoading()
      } else if (e && e.response && e.response.status === 422) {
        return swal(validationErrorTitle, validationErrorText, validationErrorType)
          .then(() => {
            setValidationErrors(e.response.data.errors)

            swal.stopLoading()
            swal.close()
          })
      } else {
        if (e && process.env.NODE_ENV !== 'production') {
          console.log(e)
        }
        unknownError()
      }
    })
}