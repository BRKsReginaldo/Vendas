import ErrorBag from "../helpers/ErrorBag"
import ErrorList from '@/components/UI/ErrorList'

export default {
  components: {ErrorList},
  data: () => ({errors: new ErrorBag()}),
  methods: {
    setErrors(errors) {
      this.$data.errors = new ErrorBag(errors)
    }
  }
}