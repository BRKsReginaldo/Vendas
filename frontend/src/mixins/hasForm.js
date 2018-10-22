import ErrorBag from "../helpers/ErrorBag"
import ErrorList from '@/components/UI/ErrorList'

export default {
  components: {ErrorList},
  data: () => ({errors: new ErrorBag()})
}