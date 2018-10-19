<script>
  import {mapActions} from 'vuex'
  import withUser from '@/mixins/withUser'

  export default {
    name: 'Navbar',
    mixins: [withUser],
    methods: {
      ...mapActions({
        toggleSidebar: 'ui/toggleSidebarOpen',
        makeLogout: 'auth/logout'
      }),
      async logout() {
        await this.makeLogout()
        this.$router.push({
          name: 'login'
        })
      }
    }
  }
</script>

<template>
    <nav class="navbar navbar-expand navbar-light bg-white">
        <a class="sidebar-toggle d-flex mr-2 pointer"
           @click="toggleSidebar">
            <span class="fas fa-bars"/>
        </a>
        <form class="form-inline done d-sm-inline-block">
            <input type="text"
                   class="form-control mr-sm-2"
                   placeholder="Buscar clients"
                   aria-label="Search">
        </form>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown"
                       aria-expanded="false">
                  <span class="d-inline-block d-md-none mr-2">
                      <span class="fas fa-cog"/>
                  </span>
                        <span class="d-none d-sm-inline-block">
                        <img :src="user.image"
                             class="avatar img-fluid rounded-circle mr-1"
                             alt="Chris Wood">
                        <span class="text-dark">{{ user.name }}</span>
                  </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><span class="fas fa-user"/> Profile</a>
                        <a class="dropdown-item" href="#"><span class="fas fa-chart-pie"/> Analytics</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Settings &amp; Privacy</a>
                        <a class="dropdown-item" href="#">Help</a>
                        <a class="dropdown-item" href="#" @click="logout">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>