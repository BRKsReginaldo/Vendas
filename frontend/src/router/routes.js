import Home from '../views/Home'
import Login from '../views/Login'
import Auth from '../components/Auth'

const Breadcrumbs = {
  home: {
    name: $t('pages.home'),
    link: {
      name: 'home'
    }
  },
  profile: {
    name: $t('pages.profile'),
    link: {
      name: 'profile'
    }
  },
  users: {
    name: $t('pages.users'),
    link: {
      name: 'users'
    }
  },
  createUsers: {
    name: $t('pages.createUsers'),
    link: {
      name: 'createUsers'
    }
  },
  trashedUsers: {
    name: $t('pages.trashedUsers'),
    link: {
      name: 'trashedUsers'
    }
  },
  clients: {
    name: $t('pages.clients'),
    link: {
      name: 'clients'
    }
  },
  disabledClients: {
    name: $t('pages.disabledClients'),
    link: {
      name: 'disabledClients'
    }
  },
  customers: {
    name: $t('pages.customers'),
    link: {
      name: 'customers'
    }
  },
  createCustomers: {
    name: $t('pages.createCustomers'),
    link: {
      name: 'createCustomers'
    }
  },
  trashedCustomers: {
    name: $t('pages.trashedCustomers'),
    link: {
      name: 'trashedCustomers'
    }
  },
  editCustomers: {
    name: $t('pages.editCustomers'),
    link: null
  },
  providers: {
    name: $t('pages.providers'),
    link: {
      name: 'providers'
    }
  },
  createProviders: {
    name: $t('pages.createProviders'),
    link: {
      name: 'createProviders'
    }
  },
  trashedProviders: {
    name: $t('pages.trashedProviders'),
    link: {
      name: 'trashedProviders'
    }
  },
  editProviders: {
    name: $t('pages.editProviders'),
    link: null
  },
  paymentTypes: {
    name: $t('pages.paymentTypes'),
    link: {
      name: 'paymentTypes'
    }
  },
  createPaymentTypes: {
    name: $t('pages.createPaymentTypes'),
    link: {
      name: 'createPaymentTypes'
    }
  },
  trashedPaymentTypes: {
    name: $t('pages.trashedPaymentTypes'),
    link: {
      name: 'trashedPaymentTypes'
    }
  },
  editPaymentTypes: {
    name: $t('pages.editPaymentTypes'),
    link: null
  },
}

export default [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      guest: true
    }
  },
  {
    path: '/',
    meta: {
      auth: true
    },
    component: Auth,
    children: [
      {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
          breadcrumbs: [
            Breadcrumbs.home
          ]
        }
      },
      {
        path: 'perfil',
        name: 'profile',
        component: () => import(/* webpackChunkName: "profile"*/ '../views/User/Profile'),
        meta: {
          can: () => $can('viewProfileUser'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.profile
          ]
        }
      },
      {
        path: 'usuarios',
        name: 'users',
        component: () => import(/* webpackChunkName: "users" */ '../views/Users/List'),
        meta: {
          can: () => $can('manageUser'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.users
          ]
        }
      },
      {
        path: 'usuarios/cadastrar',
        name: 'createUsers',
        component: () => import(/* webpackChunkName: "createUsers" */ '../views/Users/Create'),
        meta: {
          can: () => $can('createUser'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.users,
            Breadcrumbs.createUsers
          ]
        }
      },
      {
        path: 'usuarios/apagados',
        name: 'trashedUsers',
        component: () => import(/* webpackChunkName: "trashedUsers" */ '../views/Users/ListTrashed'),
        meta: {
          can: () => $can('restoreUser'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.users,
            Breadcrumbs.trashedUsers
          ]
        }
      },
      {
        path: 'clientes',
        name: 'clients',
        component: () => import(/* webpackChunkName: "clients" */ '../views/Clients/List'),
        meta: {
          can: () => $can('viewClient'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.clients
          ]
        }
      },
      {
        path: 'clientes/desativados',
        name: 'disabledClients',
        component: () => import(/* webpackChunkName: "disabledClients" */ '../views/Clients/ListDisabled'),
        meta: {
          can: () => $can('enableClient'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.clients,
            Breadcrumbs.disabledClients
          ]
        }
      },
      {
        path: 'configuracoes/clientes',
        name: 'customers',
        component: () => import(/* webpackChunkName: "customers" */ '../views/Customers/List'),
        meta: {
          can: () => $can('viewCustomer'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.customers
          ]
        }
      },
      {
        path: 'configuracoes/clientes/apagados',
        name: 'trashedCustomers',
        component: () => import(/* webpackChunkName: "trashedCustomers" */ '../views/Customers/ListTrashed'),
        meta: {
          can: () => $can('viewCustomer'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.customers,
            Breadcrumbs.trashedCustomers,
          ]
        }
      },
      {
        path: 'configuracoes/clientes/cadastrar',
        name: 'createCustomers',
        component: () => import(/* webpackChunkName: "createCustomers" */ '../views/Customers/Create'),
        meta: {
          can: () => $can('createCustomer'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.customers,
            Breadcrumbs.createCustomers
          ]
        }
      },
      {
        path: 'configuracoes/clientes/editar/:id',
        name: 'editCustomers',
        component: () => import(/* webpackChunkName: "editCustomers" */ '../views/Customers/Edit'),
        meta: {
          can: () => $can('createCustomer'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.customers,
            Breadcrumbs.editCustomers
          ]
        }
      },
      {
        path: 'configuracoes/fornecedores',
        name: 'providers',
        component: () => import(/* webpackChunkName: "providers" */ '../views/Providers/List'),
        meta: {
          can: () => $can('viewProvider'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.providers
          ]
        }
      },
      {
        path: 'configuracoes/fornecedores/cadastrar',
        name: 'createProviders',
        component: () => import(/* webpackChunkName: "createProviders" */ '../views/Providers/Create'),
        meta: {
          can: () => $can('createProvider'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.providers,
            Breadcrumbs.createProviders,
          ]
        }
      },
      {
        path: 'configuracoes/fornecedores/apagados',
        name: 'trashedProviders',
        component: () => import(/* webpackChunkName: "createProviders" */ '../views/Providers/ListTrashed'),
        meta: {
          can: () => $can('createProvider'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.providers,
            Breadcrumbs.trashedProviders,
          ]
        }
      },
      {
        path: 'configuracoes/fornecedores/editar/:id',
        name: 'editProviders',
        component: () => import(/* webpackChunkName: "editProviders" */ '../views/Providers/Edit'),
        meta: {
          can: () => $can('createProvider'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.providers,
            Breadcrumbs.editProviders,
          ]
        }
      },
      {
        path: 'configuracoes/metodos-de-pagamento',
        name: 'paymentTypes',
        component: () => import(/* webpackChunkName: "paymentTypes" */ '../views/PaymentTypes/List'),
        meta: {
          can: () => $can('viewPaymentType'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.paymentTypes
          ]
        }
      },
      {
        path: 'configuracoes/metodos-de-pagamento/cadastrar',
        name: 'createPaymentTypes',
        component: () => import(/* webpackChunkName: "createPaymentTypes" */ '../views/PaymentTypes/Create'),
        meta: {
          can: () => $can('createPaymentType'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.paymentTypes,
            Breadcrumbs.createPaymentTypes,
          ]
        }
      },
      {
        path: 'configuracoes/metodos-de-pagamento/apagados',
        name: 'trashedPaymentTypes',
        component: () => import(/* webpackChunkName: "createPaymentTypes" */ '../views/PaymentTypes/ListTrashed'),
        meta: {
          can: () => $can('createPaymentType'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.paymentTypes,
            Breadcrumbs.trashedPaymentTypes,
          ]
        }
      },
      {
        path: 'configuracoes/metodos-de-pagamento/editar/:id',
        name: 'editPaymentTypes',
        component: () => import(/* webpackChunkName: "editPaymentTypes" */ '../views/PaymentTypes/Edit'),
        meta: {
          can: () => $can('createPaymentType'),
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.paymentTypes,
            Breadcrumbs.editPaymentTypes,
          ]
        }
      },
    ]
  }
]