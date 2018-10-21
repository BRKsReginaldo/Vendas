<script>
    import ErrorBag from "../../../helpers/ErrorBag"
    import ErrorList from '@/components/UI/ErrorList'

    export default {
      name: 'PasswordField',
      components: {
        ErrorList
      },
      props: {
        errors: {
          type: Object,
          default: () => new ErrorBag()
        },
        placeholder: {
          type: String,
          default: () => 'Digite sua senha'
        },
        label: {
          type: String,
          default: () => 'Senha'
        },
        name: {
          type: String,
          default: () => 'password'
        },
        autocomplete: {
          type: String,
          default: () => 'on'
        }
      },
      data: () => ({showPassword: false}),
      watch: {
        errors(value) {
          console.log(value)
        }
      }
    }
</script>

<template>
    <div class="form-group text-left">
        <label v-text="$props.label"/>
        <div class="input-group">
            <input :type="$data.showPassword ? 'text' : 'password'"
                   class="form-control"
                   :name="$props.name"
                   :autocomplete="$props.autocomplete"
                   :placeholder="$props.placeholder">
            <div class="input-group-append bg-white">
                <div class="input-group-text"
                     @click="$data.showPassword = !$data.showPassword">
                    <span :class="['fas', $data.showPassword ? 'fa-eye-slash' : 'fa-eye']"/>
                </div>
            </div>
        </div>
        <error-list :errors="$props.errors.get($props.name)"/>
    </div>
</template>