(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["trashedCustomers"],{"112f":function(t,e,s){"use strict";var a=s("af52"),n=s.n(a),r=s("51da");e["a"]={components:{VueTable:n.a},data:function(){return{css:r["a"]}}}},"789b":function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("page",[s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 col-md-6"},[s("h1",[t._v(t._s(t.$t("pages.trashedCustomers")))])]),s("div",{staticClass:"col-12 col-md-6 text-center text-md-right mb-2 mb-md-0"},[s("router-link",{staticClass:"btn btn-info mr-2",attrs:{to:{name:"uclientes"}}},[t._v("Clientes")]),s("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"cadastrarUClientes"}}},[t._v("Cadastrar")])],1)]),s("div",{staticClass:"card shadow"},[s("div",{staticClass:"card-body p-0"},[s("vue-table",{ref:"vuetable",attrs:{"api-url":"/api/customers/trashed",fields:t.fields,"data-path":"data","http-options":t.requestAuth,"pagination-path":"meta",css:t.css.table,"no-data-template":t.$t("placeholders.noData")},scopedSlots:t._u([{key:"actions-slot",fn:function(e){var a=e.rowData;return s("div",{},[s("button",{staticClass:"btn btn-success",on:{click:function(e){t.restore(a)}}},[t._v("Restaurar\n                    ")])])}}])})],1)])])},n=[],r=s("112f"),o=s("7a43"),i=s("b4bb"),c={name:"Customers",meta:{title:$t("pages.trashedCustomers")},mixins:[r["a"],o["a"]],data:function(){return{fields:[{name:"name",sortField:"name",title:$t("labels.name")},{name:"phone",sortField:"phone",title:$t("labels.phone")},{name:"actions-slot",title:$t("labels.actions")}]}},methods:{restore:function(t){var e=this;swal({icon:"warning",title:$t("notifications.title.confirm"),text:$t("notifications.message.customer.restore.confirm"),buttons:{cancel:"Cancelar",confirm:{text:"Confirmar",value:!0,closeModal:!1}},dangerMode:!0}).then(function(e){return e?i["a"].restore(t):Promise.reject(!1)}).then(function(t){return swal($t("notifications.title.success"),$t("notifications.message.customer.restore.success"),"success")}).then(function(){e.$refs.vuetable.reload()}).catch(function(t){swal.close(),swal.stopLoading(),t&&unknownError()})}}},u=c,l=s("2877"),d=Object(l["a"])(u,a,n,!1,null,null,null);d.options.__file="index.vue";e["default"]=d.exports},b4bb:function(t,e,s){"use strict";var a=s("451e");e["a"]={create:function(t){return $can("createCustomer")?a["a"].post("/api/customers",t):unauthorizedError().then(function(){return Promise.reject(!1)})},delete:function(t){return $can("deleteCustomer",t)?a["a"].laravelDelete("/api/customers/".concat(t.id)):unauthorizedError().then(function(){return Promise.reject(!1)})},restore:function(t){return $can("restoreCustomer",t)?a["a"].laravelPut("/api/customers/restore/".concat(t.id)):unauthorizedError().then(function(){return Promise.reject(!1)})}}}}]);
//# sourceMappingURL=trashedCustomers.27120faa.js.map