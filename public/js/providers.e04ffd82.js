(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["providers"],{f8d5:function(t,e,s){"use strict";s.r(e);var r=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("page",[s("div",{staticClass:"row"},[s("div",{staticClass:"col-12 col-sm-4 col-md-6"},[s("h1",[t._v(t._s(t.$t("pages.providers")))])]),s("div",{staticClass:"col-12 col-sm-8 col-md-6 text-center text-sm-right mb-2 mb-md-0"},[s("router-link",{staticClass:"btn btn-info mr-2",attrs:{to:{name:"trashedProviders"}}},[t._v("Fornecedores Apagados")]),s("router-link",{staticClass:"btn btn-primary ",attrs:{to:{name:"createProviders"}}},[t._v("Cadastrar")])],1)]),s("div",{staticClass:"card shadow"},[s("div",{staticClass:"card-body p-0"},[s("list",{ref:"vuetable",attrs:{"has-actions":"",fields:t.fields,url:"/api/providers"},scopedSlots:t._u([{key:"actions",fn:function(e){var r=e.rowData;return s("div",{},[s("button",{staticClass:"btn btn-danger mr-2",on:{click:function(e){t.dropProvider(r)}}},[t._v("Apagar\n                    ")]),s("router-link",{staticClass:"btn btn-primary",attrs:{to:{name:"editProviders",params:{id:r.id}}}},[t._v("\n                        Editar\n                    ")])],1)}}])})],1)])])},a=[],i=(s("1940"),s("25fc"),s("5231")),n={name:"ListProviders",meta:{title:$t("pages.providers")},components:{List:i["a"]},data:function(){return{count:0,fields:[{name:"name",sortField:"name",title:$t("labels.name")}]}},methods:{dropProvider:function(t){var e=this;this.mutate("deleteProvider",{provider:t,onSuccess:function(){return e.$refs.vuetable.reload()}})}}},o=n,d=s("2877"),l=Object(d["a"])(o,r,a,!1,null,null,null);l.options.__file="index.vue";e["default"]=l.exports}}]);
//# sourceMappingURL=providers.e04ffd82.js.map