import UserPolicy from "../policies/UserPolicy"
import CustomerPolicy from "../policies/CustomerPolicy"
import ClientPolicy from "../policies/ClientPolicy"
import ProviderPolicy from "../policies/ProviderPolicy"
import PaymentTypePolicy from "../policies/PaymentTypePolicy"
import ProductPolicy from "../policies/ProductPolicy"

export default {
  User: UserPolicy,
  Customer: CustomerPolicy,
  Client: ClientPolicy,
  Provider: ProviderPolicy,
  PaymentType: PaymentTypePolicy,
  Product: ProductPolicy
}