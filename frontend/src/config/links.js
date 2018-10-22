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
      icon: 'fas fa-cog',
      title: 'Configurações',
      can: () => $can('viewCustomer') || $can('viewClient') || $can('manageUser'),
      links: [
        {
          icon: 'fas fa-user',
          title: () => $t('pages.users'),
          link: {
            name: 'usuarios'
          },
          can: () => $can('manageUser')
        },
        {
          icon: 'fas fa-user',
          title: () => $t('pages.clients'),
          link: {
            name: 'clientes'
          },
          can: () => $can('viewClient')
        },
        {
          title: () => $t('pages.customers'),
          link: {
            name: 'uclientes'
          },
          can: () => $can('viewCustomer'),
          badge: () => ({
            type: 'warning',
            value: 'novo'
          })
        },
      ]
    }
  ]
}