<script>
  import ErrorList from '@/components/UI/ErrorList'
  import ErrorBag from "../../helpers/ErrorBag"
  import {mapActions} from 'vuex'
  import PasswordField from '@/components/UI/PasswordField'

  export default {
    name: 'Login',
    meta: {
      title: $t('pages.login')
    },
    components: {
      ErrorList,
      PasswordField
    },
    data: () => ({showPassword: false, errors: new ErrorBag(), loading: false}),
    methods: {
      ...mapActions({
        login: 'auth/login'
      }),
      async onSubmit(ev) {
        ev.preventDefault()

        const FD = new FormData(ev.target)
        this.$data.loading = true

        try {
          await this.login({
            email: FD.get('email'),
            password: FD.get('password')
          })

          this.$router.push({
            name: 'home'
          })
        } catch(e) {
          if (e.hasOwnProperty('errors')) {
            this.$data.errors = new ErrorBag(e.errors)
          }
        } finally {
          this.$data.loading = false
        }

        return false
      }
    }
  }
</script>

<template>
    <div class="container text-center pt-5">
        <div class="card d-inline-block mt-5">
            <div class="card-title pt-4">
                <h4>{{ $t('login.signin')}}</h4>
            </div>
            <div class="card-body mx-2">
                <form @submit="onSubmit">
                    <error-list :errors="$data.errors.get('general')"/>

                    <div class="form-group text-left">
                        <label>{{ $t('labels.email') }} </label>
                        <input
                                type="email"
                                class="form-control"
                                name="email"
                                :placeholder="$t('placeholders.email')">
                        <error-list :errors="$data.errors.get('email')"/>
                    </div>
                    <password-field
                            :placeholder="$t('placeholders.password')"
                            :errors="$data.errors"/>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ $t('login.signin') }} <span class="fas fa-spinner fa-spin" v-show="loading"/></button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="#">{{ $t('login.forgot') }}</a>
            </div>
        </div>
    </div>
</template>