export default () => [
  'Principal',
  {
    icon: 'fas fa-home',
    title: 'Dashboard',
    link: '/',
    badge: () => ({
      type: 'primary',
      value: '6'
    })
  },
  {
    icon: 'fas fa-user',
    title: () => $t('pages.users'),
    link: '/usuarios',
    can: () => $can('createUser')
  },
  {
    icon: 'fas fa-user',
    title: 'Pages',
    links: [
      {
        title: 'Entrar',
        link: '/entrar',
      },
      {
        title: 'Badge Test',
        link: '/badge',
        badge: () => ({
          type: 'warning',
          value: 'new'
        })
      }
    ]
  },
]