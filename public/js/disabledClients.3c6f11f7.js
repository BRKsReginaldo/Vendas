(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["disabledClients"],{4120:function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("page",[n("div",{staticClass:"row"},[n("div",{staticClass:"col-12 col-sm-8 col-md-6"},[n("h1",[t._v(t._s(t.$t("pages.disabledClients")))])]),n("div",{staticClass:"col-12 col-sm-4 col-md-6 text-center text-md-right mb-2 mb-md-0"},[n("router-link",{staticClass:"btn btn-info",attrs:{to:{name:"clients"}}},[t._v("Clientes")])],1)]),n("div",{staticClass:"card shadow"},[n("div",{staticClass:"card-body p-0"},[n("vue-table",{ref:"vuetable",attrs:{"api-url":"/api/clients/disabled",fields:t.fields,"data-path":"data","http-options":t.requestAuth,"pagination-path":"meta",css:t.css.table},scopedSlots:t._u([{key:"actions-slot",fn:function(e){var a=e.rowData;return n("div",{},[n("button",{staticClass:"btn btn-primary",on:{click:function(e){t.enable(a.id)}}},[t._v("Ativar\n                    ")])])}}])})],1)])])},i=[],s=n("af52"),c=n.n(s),l=n("51da"),o=n("1940"),r=n.n(o),u=(n("35ca"),n("7a43")),d=n("c134"),b={name:"DisabledClientes",components:{VueTable:c.a},mixins:[u["a"]],meta:{title:$t("pages.disabledClients")},data:function(){return{css:l["a"],fields:[{name:"id",sortField:"id",title:$t("labels.id")},{name:"creator.name",title:$t("labels.creator")},{name:"actions-slot",title:$t("labels.actions")}]}},methods:{enable:function(t){var e=this;r()({icon:"warning",title:$t("notifications.title.confirm"),text:$t("notifications.message.client.enable.confirm"),buttons:{cancel:"Cancelar",confirm:{text:"Confirmar",value:!0,closeModal:!1}},dangerMode:!0}).then(function(e){return e?d["a"].enable(t):Promise.reject(!1)}).then(function(t){return r()($t("notifications.title.success"),$t("notifications.message.client.enable.success"),"success")}).then(function(){e.$refs.vuetable.reload()}).catch(function(t){r.a.close(),r.a.stopLoading(),t&&unknownError()})}}},f=b,m=n("2877"),p=Object(m["a"])(f,a,i,!1,null,null,null);p.options.__file="index.vue";e["default"]=p.exports},c134:function(t,e,n){"use strict";var a=n("451e");e["a"]={create:function(t){return $can("createClient",t)?a["a"].post("/api/clients",{user_id:t}):unauthorizedError().then(function(){return Promise.reject(!1)})},disable:function(t){return $can("disableClient",t)?a["a"].laravelDelete("/api/clients/disable/".concat(t)):unauthorizedError().then(function(){return Promise.reject(!1)})},enable:function(t){return $can("enableClient",t)?a["a"].laravelPut("/api/clients/enable/".concat(t)):unauthorizedError().then(function(){return Promise.reject(!1)})}}}}]);
//# sourceMappingURL=disabledClients.3c6f11f7.js.map