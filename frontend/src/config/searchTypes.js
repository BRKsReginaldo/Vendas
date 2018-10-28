export default () => [
  {
    value: 'customers',
    label: $t('pages.customers'),
    can: () => $can('viewCustomer')
  },
  {
    value: 'providers',
    label: $t('pages.providers'),
    can: () => $can('viewProvider')
  },
  {
    value: 'paymentMethods',
    label: $t('pages.payments'),
    can: () => $can('viewPaymentType')
  },
  {
    value: 'products',
    label: $t('pages.products'),
    can: () => $can('viewProduct')
  },
  {
    value: 'users',
    label: $t('pages.users'),
    can: () => $can('createUser')
  },
]