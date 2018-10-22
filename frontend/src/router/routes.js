import Home from '../views/Home'
import Login from '../views/Login'
import Auth from '../components/Auth'

const Breadcrumbs = {
  home: {
    name: 'Home',
    link: {
      name: 'home'
    }
  },
  perfil: {
    name: 'Perfil',
    link: {
      name: 'perfil'
    }
  },
  usuarios: {
    name: 'Usuarios',
    link: {
      name: 'usuarios'
    }
  },
  cadastrarUsuarios: {
    name: 'Cadastrar Usuarios',
    link: {
      name: 'cadastrarUsuarios'
    }
  },
  usuariosApagados: {
    name: 'Usuários Apagados',
    link: {
      name: 'usuariosApagados'
    }
  },
  clientes: {
    name: 'Clientes',
    link: {
      name: 'clientes'
    }
  },
  clientesDesativados: {
    name: 'Clientes Desativados',
    link: {
      name: 'clientesDesativados'
    }
  }
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
        name: 'perfil',
        component: () => import(/* webpackChunkName: "profile"*/ '../views/Profile'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.perfil
          ]
        }
      },
      {
        path: 'usuarios',
        name: 'usuarios',
        component: () => import(/* webpackChunkName: "users" */ '../views/Users'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.usuarios
          ]
        }
      },
      {
        path: 'usuarios/cadastrar',
        name: 'cadastrarUsuarios',
        component: () => import(/* webpackChunkName: "createUsers" */ '../views/CreateUsers'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.usuarios,
            Breadcrumbs.cadastrarUsuarios
          ]
        }
      },
      {
        path: 'usuarios/apagados',
        name: 'usuariosApagados',
        component: () => import(/* webpackChunkName: "trashedUsers" */ '../views/TrashedUsers'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.usuarios,
            Breadcrumbs.usuariosApagados
          ]
        }
      },
      {
        path: 'clientes',
        name: 'clientes',
        component: () => import(/* webpackChunkName: "clients" */ '../views/Clients'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.clientes
          ]
        }
      },
      {
        path: 'clientes/desativados',
        name: 'clientesDesativados',
        component: () => import(/* webpackChunkName: "disabledClients" */ '../views/DisabledClients'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.clientes,
            Breadcrumbs.clientesDesativados
          ]
        }
      }
    ]
  }
]