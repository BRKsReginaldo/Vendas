(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["customers"],{"35e5":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("page",[e("div",{staticClass:"row"},[e("div",{staticClass:"col-12 col-md-6"},[e("h1",[t._v(t._s(t.$t("pages.customers")))])]),e("div",{staticClass:"col-12 col-md-6 text-center text-md-right mb-2 mb-md-0"},[e("router-link",{staticClass:"btn btn-info mr-2",attrs:{to:{name:"trashedCustomers"}}},[t._v("Clientes Apagados")]),e("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"createCustomers"}}},[t._v("Cadastrar")])],1)]),e("div",{staticClass:"card shadow"},[e("div",{staticClass:"card-body p-0"},[e("list",{ref:"vuetable",attrs:{url:"/api/customers",fields:t.fields,"has-actions":""},scopedSlots:t._u([{key:"actions",fn:function(s){var a=s.rowData;return e("div",{},[e("button",{staticClass:"btn btn-danger mr-2",on:{click:function(s){t.dropCustomer(a)}}},[t._v("Apagar\n                    ")]),e("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"editCustomers",params:{id:a.id}}}},[t._v("\n                        Editar\n                    ")])],1)}}])})],1)])])},n=[],r=(e("b4bb"),e("5231")),o={name:"Customers",meta:{title:$t("pages.customers")},components:{List:r["a"]},data:function(){return{fields:[{name:"name",sortField:"name",title:$t("labels.name")},{name:"phone",sortField:"phone",title:$t("labels.phone")}]}},methods:{dropCustomer:function(t){var s=this;this.mutate("deleteCustomer",{customer:t,onSuccess:function(){return s.$refs.vuetable.reload()}})}}},i=o,l=e("2877"),c=Object(l["a"])(i,a,n,!1,null,null,null);c.options.__file="index.vue";s["default"]=c.exports}}]);
//# sourceMappingURL=customers.cf8af465.js.map