export default async () => {
  return [
    'Principal',
    {
      icon: 'fas fa-home',
      title: 'Dashboard',
      link: {
        name: 'home'
      },
      badge: () => ({
        type: 'primary',
        value: '6'
      })
    },
    {
      icon: 'fas fa-shopping-cart',
      title: () => $t('pages.productsPurcharged'),
      link: {
        name: 'productsPurcharged'
      }
    },
    {
      icon: 'fas fa-cog',
      title: 'Configurações',
      can: () =>
        $can('viewCustomer') ||
        $can('viewClient') ||
        $can('manageUser') ||
        $can('viewClient') ||
        $can('viewCustomer') ||
        $can('viewPaymentType') ||
        $can('viewProduct'),
      links: [
        {
          icon: 'fas fa-user',
          title: () => $t('pages.users'),
          link: {
            name: 'users'
          },
          can: () => $can('manageUser')
        },
        {
          icon: 'fas fa-user',
          title: () => $t('pages.clients'),
          link: {
            name: 'clients'
          },
          can: () => $can('viewClient')
        },
        {
          title: () => $t('pages.customers'),
          link: {
            name: 'customers'
          },
          can: () => $can('viewCustomer'),
          badge: () => ({
            type: 'warning',
            value: 'novo'
          })
        },
        {
          title: () => $t('pages.providers'),
          link: {
            name: 'providers'
          },
          can: () => $can('viewProvider'),
          badge: () => ({
            type: 'warning',
            value: 'novo'
          })
        },
        {
          title: () => $t('pages.payments'),
          link: {
            name: 'paymentTypes'
          },
          can: () => $can('viewPaymentType'),
          badge: () => ({
            type: 'warning',
            value: 'novo'
          })
        },
        {
          title: () => $t('pages.products'),
          link: {
            name: 'products'
          },
          can: () => $can('viewProduct'),
          badge: () => ({
            type: 'warning',
            value: 'novo'
          })
        },
      ]
    },
    {
      icon: 'fas fa-search-dollar',
      title: 'Logs',
      can: () =>
        $can('viewLog'),
      links: [
        {
          title: $t('pages.stock'),
          link: {
            name: 'stock'
          }
        }
      ]
    }
  ]
}