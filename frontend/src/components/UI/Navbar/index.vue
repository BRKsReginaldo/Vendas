<script>
  import {mapActions} from 'vuex'
  import withUser from '@/mixins/withUser'
  import searchTypes from '@/config/searchTypes'

  export default {
    name: 'Navbar',
    mixins: [withUser],
    props: {
      links: {
        type: Array,
        required: true
      }
    },
    data: () => ({
      searchType: 'customers',
    }),
    computed: {
      searchTypes() {
        return searchTypes()
      }
    },
    watch: {
      user(user) {
        if (user.roles.some(role => role.name === 'admin')) {
          this.$data.searchType = 'users'
        }
      }
    },
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
      },
      search(ev) {
        const search = ev.target.value
        ev.target.value = ''

        this.$router.push({
          name: this.$data.searchType,
          query: {
            search
          }
        })
      }
    }
  }
</script>

<template>
    <nav class="navbar navbar-expand navbar-light bg-white">
        <a class="sidebar-toggle d-flex mr-2 pointer justify-content-center align-items-center"
           @click="toggleSidebar">
            <span class="fas fa-bars"/>
        </a>
        <div class="form-inline done d-none d-sm-inline-block">
            <input type="text"
                   class="form-control mr-sm-2"
                   :placeholder="$t('placeholders.search')"
                   @keyup.enter="search"
                   aria-label="Search">

            <select v-model="searchType" class="form-control">
                <option v-for="(option,i) in searchTypes"
                        :key="i"
                        :value="option.value"
                        v-if="option.can ? option.can() : true"
                        v-text="option.label"/>
            </select>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown"
                       aria-expanded="false">
                  <span class="d-inline-block d-md-none mr-2">
                      <span class="fas fa-cog"/>
                  </span>
                        <span class="d-none d-sm-inline-block">
                        <img :src="user && user.image_small"
                             class="avatar img-fluid rounded-circle mr-1"
                             :alt="user && user.name">
                        <span class="text-dark">{{ user && user.name }}</span>
                  </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <template v-for="(link,i) in links">
                            <div v-if="typeof link === 'string'" :key="i" class="dropdown-divider"/>
                            <router-link v-else :key="i" :to="link.link" class="dropdown-item"><span
                                    :class="link.icon"/> {{ link.title }}
                            </router-link>
                        </template>
                        <a class="dropdown-item" href="#" @click="logout">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>