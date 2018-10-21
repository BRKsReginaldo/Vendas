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
        component: () => import(/* webpackChunkName: users */ '../views/Users'),
        meta: {
          breadcrumbs: [
            Breadcrumbs.home,
            Breadcrumbs.usuarios
          ]
        }
      }
    ]
  }
]