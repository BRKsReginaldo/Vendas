import UserPolicy from "../policies/UserPolicy"
import CustomerPolicy from "../policies/CustomerPolicy"
import ClientPolicy from "../policies/ClientPolicy"
import ProviderPolicy from "../policies/ProviderPolicy"

export default {
  User: UserPolicy,
  Customer: CustomerPolicy,
  Client: ClientPolicy,
  Provider: ProviderPolicy
}