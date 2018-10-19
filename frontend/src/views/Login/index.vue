<script>
  import ErrorList from '@/components/UI/ErrorList'
  import ErrorBag from "../../helpers/ErrorBag"
  import {mapActions} from 'vuex'

  export default {
    name: 'Login',
    components: {
      ErrorList
    },
    data: () => ({showPassword: false, errors: new ErrorBag()}),
    methods: {
      ...mapActions({
        login: 'auth/login'
      }),
      async onSubmit(ev) {
        ev.preventDefault()

        const FD = new FormData(ev.target)

        const result = await this.login({
          email: FD.get('email'),
          password: FD.get('password')
        })

        if (result.hasOwnProperty('errors')) {
          this.$data.errors = new ErrorBag(result.errors)
        } else {
          this.$router.push({
            name: 'home'
          })
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
                <h4>Entrar</h4>
            </div>
            <div class="card-body mx-2">
                <form @submit="onSubmit">
                    <error-list :errors="$data.errors.get('general')"/>

                    <div class="form-group text-left">
                        <label>Email</label>
                        <input
                                type="text"
                                class="form-control"
                                name="email"
                                placeholder="Digite seu email">
                        <error-list :errors="$data.errors.get('email')"/>
                    </div>
                    <div class="form-group text-left">
                        <label>Senha</label>
                        <div class="input-group">
                            <input :type="$data.showPassword ? 'text' : 'password'"
                                   class="form-control"
                                   name="password"
                                   placeholder="Digite sua senha">
                            <div class="input-group-append bg-white">
                                <div class="input-group-text"
                                     @click="$data.showPassword = !$data.showPassword">
                                    <span :class="['fas', $data.showPassword ? 'fa-eye-slash' : 'fa-eye']"/>
                                </div>
                            </div>
                        </div>
                        <error-list :errors="$data.errors.get('password')"/>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="#">esqueceu sua senha ?</a>
            </div>
        </div>
    </div>
</template>