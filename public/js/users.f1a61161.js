(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["users"],{"42ff":function(n,t,r){"use strict";function e(n,t){return void 0===t?t=>e(n,t):n+t}function u(n){return function(t,...r){let e=0;const u=(...n)=>t.apply(null,[...n,e++]);return n.apply(null,[u,...r])}}function i(n,t,r){if(void 0===t)return(t,r)=>i(n,t,r);if(void 0===r)return r=>i(n,t,r);const e=r.concat();return e.map((e,u)=>{return u===t?n(r[t]):e})}function o(n,t){const r={};for(const e in t)n(t[e],e)&&(r[e]=t[e]);return r}function c(n,t){if(1===arguments.length)return t=>c(n,t);if(void 0===t)return[];if(!Array.isArray(t))return o(n,t);let r=-1,e=0;const u=t.length,i=[];while(++r<u){const u=t[r];n(u)&&(i[e++]=u)}return i}function f(n,t){return 1===arguments.length?t=>f(n,t):c(n,t).length===t.length}function l(n,t){if(1===arguments.length)return t=>l(n,t);let r=0;while(r<t.length){if(n(t[r],r))return!0;r++}return!1}function s(n,t){return 1===arguments.length?t=>s(n,t):!l(n=>!n(t),n)}function d(n){return()=>n}function a(n,t){return 1===arguments.length?t=>a(n,t):l(n=>n(t))(n)}function h(n,t){if(1===arguments.length)return t=>h(n,t);if("string"===typeof t)return`${t}${n}`;const r=t.concat();return r.push(n),r}function g(n,t=[]){return(...r)=>(t=>t.length>=n.length?n(...t):g(n,t))([...t,...r])}function p(n,t,r){return Object.assign({},r,{[n]:t})}r.r(t),r.d(t,"add",function(){return e}),r.d(t,"addIndex",function(){return u}),r.d(t,"adjust",function(){return i}),r.d(t,"all",function(){return f}),r.d(t,"allPass",function(){return s}),r.d(t,"always",function(){return d}),r.d(t,"any",function(){return l}),r.d(t,"anyPass",function(){return a}),r.d(t,"append",function(){return h}),r.d(t,"assoc",function(){return m}),r.d(t,"both",function(){return y}),r.d(t,"complement",function(){return v}),r.d(t,"compose",function(){return b}),r.d(t,"concat",function(){return w}),r.d(t,"contains",function(){return k}),r.d(t,"curry",function(){return g}),r.d(t,"dec",function(){return x}),r.d(t,"defaultTo",function(){return $}),r.d(t,"dissoc",function(){return O}),r.d(t,"divide",function(){return C}),r.d(t,"drop",function(){return S}),r.d(t,"dropLast",function(){return U}),r.d(t,"either",function(){return _}),r.d(t,"endsWith",function(){return E}),r.d(t,"equals",function(){return j}),r.d(t,"F",function(){return F}),r.d(t,"filter",function(){return c}),r.d(t,"find",function(){return B}),r.d(t,"findIndex",function(){return N}),r.d(t,"flatten",function(){return P}),r.d(t,"flip",function(){return L}),r.d(t,"forEach",function(){return D}),r.d(t,"groupBy",function(){return R}),r.d(t,"has",function(){return z}),r.d(t,"head",function(){return J}),r.d(t,"identity",function(){return M}),r.d(t,"ifElse",function(){return T}),r.d(t,"inc",function(){return G}),r.d(t,"includes",function(){return H}),r.d(t,"indexBy",function(){return K}),r.d(t,"indexOf",function(){return Q}),r.d(t,"init",function(){return X}),r.d(t,"is",function(){return Y}),r.d(t,"isNil",function(){return Z}),r.d(t,"join",function(){return nn}),r.d(t,"keys",function(){return tn}),r.d(t,"last",function(){return rn}),r.d(t,"lastIndexOf",function(){return en}),r.d(t,"length",function(){return un}),r.d(t,"map",function(){return I}),r.d(t,"match",function(){return on}),r.d(t,"merge",function(){return cn}),r.d(t,"max",function(){return fn}),r.d(t,"maxBy",function(){return ln}),r.d(t,"min",function(){return sn}),r.d(t,"minBy",function(){return an}),r.d(t,"modulo",function(){return hn}),r.d(t,"multiply",function(){return gn}),r.d(t,"none",function(){return pn}),r.d(t,"not",function(){return mn}),r.d(t,"nth",function(){return yn}),r.d(t,"omit",function(){return vn}),r.d(t,"partialCurry",function(){return bn}),r.d(t,"path",function(){return wn}),r.d(t,"pathOr",function(){return jn}),r.d(t,"pick",function(){return kn}),r.d(t,"pickAll",function(){return xn}),r.d(t,"pipe",function(){return $n}),r.d(t,"pluck",function(){return On}),r.d(t,"prepend",function(){return Cn}),r.d(t,"prop",function(){return Sn}),r.d(t,"propEq",function(){return Un}),r.d(t,"range",function(){return _n}),r.d(t,"reduce",function(){return En}),r.d(t,"reject",function(){return Fn}),r.d(t,"repeat",function(){return Bn}),r.d(t,"replace",function(){return Nn}),r.d(t,"reverse",function(){return Pn}),r.d(t,"sort",function(){return Wn}),r.d(t,"sortBy",function(){return Ln}),r.d(t,"split",function(){return qn}),r.d(t,"splitEvery",function(){return In}),r.d(t,"startsWith",function(){return Dn}),r.d(t,"subtract",function(){return Rn}),r.d(t,"T",function(){return zn}),r.d(t,"tail",function(){return Jn}),r.d(t,"take",function(){return Mn}),r.d(t,"takeLast",function(){return Tn}),r.d(t,"tap",function(){return Gn}),r.d(t,"test",function(){return Hn}),r.d(t,"times",function(){return Kn}),r.d(t,"toLower",function(){return Qn}),r.d(t,"toString",function(){return Vn}),r.d(t,"toUpper",function(){return Xn}),r.d(t,"trim",function(){return Yn}),r.d(t,"type",function(){return A}),r.d(t,"uniq",function(){return Zn}),r.d(t,"uniqWith",function(){return nt}),r.d(t,"update",function(){return tt}),r.d(t,"values",function(){return rt}),r.d(t,"without",function(){return et}),r.d(t,"zip",function(){return ut}),r.d(t,"zipObj",function(){return it});const m=g(p);function y(n,t){return 1===arguments.length?t=>y(n,t):r=>n(r)&&t(r)}function v(n){return t=>!n(t)}function b(...n){return(...t)=>{const r=n.slice();if(r.length>0){const n=r.pop();let e=n(...t);while(r.length>0)e=r.pop()(e);return e}}}function w(n,t){return 1===arguments.length?t=>w(n,t):"string"===typeof n?`${n}${t}`:[...n,...t]}function A(n){const t=typeof n;if(null===n)return"Null";if(void 0===n)return"Undefined";if("boolean"===t)return"Boolean";if("number"===t)return"Number";if("string"===t)return"String";if(Array.isArray(n))return"Array";if(n instanceof RegExp)return"RegExp";const r=n.toString();return r.startsWith("async")?"Async":"[object Promise]"===r?"Promise":r.includes("function")||r.includes("=>")?"Function":"Object"}function j(n,t){if(1===arguments.length)return t=>j(n,t);if(n===t)return!0;const r=A(n);if(r!==A(t))return!1;if("Array"===r){const r=Array.from(n),e=Array.from(t);if(r.toString()!==e.toString())return!1;let u=!0;return r.forEach((n,t)=>{u&&(n===e[t]||j(n,e[t])||(u=!1))}),u}if("Object"===r){const r=Object.keys(n);if(r.length!==Object.keys(t).length)return!1;let e=!0;return r.forEach(r=>{if(e){const u=n[r],i=t[r];u===i||j(u,i)||(e=!1)}}),e}return!1}function k(n,t){if(1===arguments.length)return t=>k(n,t);let r=-1,e=!1;while(++r<t.length&&!e)j(t[r],n)&&(e=!0);return e}const x=n=>n-1;function $(n,t){return 1===arguments.length?t=>$(n,t):void 0===t||null===t||!0===Number.isNaN(t)?n:t}function O(n,t){if(1===arguments.length)return t=>O(n,t);if(null===t||void 0===t)return{};const r={};for(const e in t)r[e]=t[e];return delete r[n],r}function C(n,t){return 1===arguments.length?t=>C(n,t):n/t}function S(n,t){return 1===arguments.length?t=>S(n,t):t.slice(n)}function U(n,t){return 1===arguments.length?t=>U(n,t):t.slice(0,-n)}function _(n,t){return 1===arguments.length?t=>_(n,t):r=>n(r)||t(r)}function E(n,t){return 1===arguments.length?t=>E(n,t):t.endsWith(n)}function F(){return!1}function B(n,t){return 1===arguments.length?t=>B(n,t):t.find(n)}function N(n,t){if(1===arguments.length)return t=>N(n,t);const r=t.length;let e=-1;while(++e<r)if(n(t[e]))return e;return-1}function P(n,t){t=void 0===t?[]:t;for(let r=0;r<n.length;r++)Array.isArray(n[r])?P(n[r],t):t.push(n[r]);return t}function W(n){return(...t)=>{return 1===t.length?r=>n(r,t[0]):2===t.length?n(t[1],t[0]):void 0}}function L(n,...t){return W(n)}function q(n,t){const r={};for(const e in t)r[e]=n(t[e],e);return r}function I(n,t){if(1===arguments.length)return t=>I(n,t);if(void 0===t)return[];if(!Array.isArray(t))return q(n,t);let r=-1;const e=t.length,u=Array(e);while(++r<e)u[r]=n(t[r]);return u}function D(n,t){return 1===arguments.length?t=>D(n,t):(I(n,t),t)}function R(n,t){if(1===arguments.length)return t=>R(n,t);const r={};for(let e=0;e<t.length;e++){const u=t[e],i=n(u);r[i]||(r[i]=[]),r[i].push(u)}return r}function z(n,t){return 1===arguments.length?t=>z(n,t):void 0!==t[n]}function J(n){return"string"===typeof n?n[0]||"":n[0]}function M(n){return n}function T(n,t,r){return void 0===t?(t,r)=>T(n,t,r):void 0===r?r=>T(n,t,r):e=>{const u="boolean"===typeof n?n:n(e);return!0===u?t(e):r(e)}}const G=n=>n+1;function H(n,t){return 1===arguments.length?t=>H(n,t):t.includes(n)}function K(n,t){if(1===arguments.length)return t=>K(n,t);const r={};for(let e=0;e<t.length;e++){const u=t[e];r[n(u)]=u}return r}function Q(n,t){if(1===arguments.length)return t=>Q(n,t);let r=-1;const e=t.length;while(++r<e)if(t[r]===n)return r;return-1}function V(n,t,r){let e=-1,u=n.length;r=r>u?u:r,r<0&&(r+=u),u=t>r?0:r-t>>>0,t>>>=0;const i=Array(u);while(++e<u)i[e]=n[e+t];return i}function X(n){return"string"===typeof n?n.slice(0,-1):n.length?V(n,0,-1):[]}function Y(n,t){return 1===arguments.length?t=>Y(n,t):null!=t&&t.constructor===n||t instanceof n}function Z(n){return void 0===n||null===n}function nn(n,t){return 1===arguments.length?t=>nn(n,t):t.join(n)}function tn(n){return Object.keys(n)}function rn(n){return"string"===typeof n?n[n.length-1]||"":n[n.length-1]}function en(n,t){if(1===arguments.length)return t=>en(n,t);let r=-1;return t.map((t,e)=>{j(t,n)&&(r=e)}),r}function un(n){return n.length}function on(n,t){if(1===arguments.length)return t=>on(n,t);const r=t.match(n);return null===r?[]:r}function cn(n,t){return 1===arguments.length?t=>cn(n,t):Object.assign({},n||{},t||{})}function fn(n,t){return 1===arguments.length?t=>fn(n,t):t>n?t:n}function ln(n,t,r){return 2===arguments.length?r=>ln(n,t,r):1===arguments.length?(t,r)=>ln(n,t,r):n(r)>n(t)?r:t}function sn(n,t){return 1===arguments.length?t=>sn(n,t):t<n?t:n}function dn(n,t,r){return n(r)<n(t)?r:t}const an=g(dn);function hn(n,t){return 1===arguments.length?t=>hn(n,t):n%t}function gn(n,t){return 1===arguments.length?t=>gn(n,t):n*t}function pn(n,t){return 1===arguments.length?t=>pn(n,t):0===t.filter(n).length}function mn(n){return!n}function yn(n,t){if(1===arguments.length)return t=>yn(n,t);const r=n<0?t.length+n:n;return"[object String]"===Object.prototype.toString.call(t)?t.charAt(r):t[r]}function vn(n,t){if(1===arguments.length)return t=>vn(n,t);if(null===t||void 0===t)return;const r="string"===typeof n?n=n.split(","):n,e={};for(const u in t)r.includes(u)||(e[u]=t[u]);return e}function bn(n,t={}){return r=>{return"Async"===A(n)||"Promise"===A(n)?new Promise((e,u)=>{n(cn(r,t)).then(e).catch(u)}):n(cn(r,t))}}function wn(n,t){if(1===arguments.length)return t=>wn(n,t);if(null===t||void 0===t)return;let r=t,e=0;const u="string"===typeof n?n.split("."):n;while(e<u.length){if(null===r||void 0===r)return;r=r[u[e]],e++}return r}function An(n,t,r){return $(n,wn(t,r))}const jn=g(An);function kn(n,t){if(1===arguments.length)return t=>kn(n,t);if(null===t||void 0===t)return;const r="string"===typeof n?n.split(","):n,e={};let u=0;while(u<r.length)r[u]in t&&(e[r[u]]=t[r[u]]),u++;return e}function xn(n,t){if(1===arguments.length)return t=>xn(n,t);if(null===t||void 0===t)return;const r="string"===typeof n?n.split(","):n,e={};let u=0;while(u<r.length)r[u]in t?e[r[u]]=t[r[u]]:e[r[u]]=void 0,u++;return e}function $n(...n){return b(...n.reverse())}function On(n,t){if(1===arguments.length)return t=>On(n,t);const r=[];return I(t=>{void 0!==t[n]&&r.push(t[n])},t),r}function Cn(n,t){if(1===arguments.length)return t=>Cn(n,t);if("string"===typeof t)return`${n}${t}`;const r=t.concat();return r.unshift(n),r}function Sn(n,t){return 1===arguments.length?t=>Sn(n,t):t[n]}function Un(n,t,r){return void 0===t?(t,r)=>Un(n,t,r):void 0===r?r=>Un(n,t,r):r[n]===t}function _n(n,t){if(1===arguments.length)return t=>_n(n,t);const r=[];for(let e=n;e<t;e++)r.push(e);return r}function En(n,t,r){return void 0===t?(t,r)=>En(n,t,r):void 0===r?r=>En(n,t,r):r.reduce(n,t)}function Fn(n,t){return 1===arguments.length?t=>Fn(n,t):c(t=>!n(t),t)}function Bn(n,t){if(1===arguments.length)return t=>Bn(n,t);const r=Array(t);return r.fill(n)}function Nn(n,t,r){return void 0===t?(t,r)=>Nn(n,t,r):void 0===r?r=>Nn(n,t,r):r.replace(n,t)}function Pn(n){const t=n.concat();return t.reverse()}function Wn(n,t){if(1===arguments.length)return t=>Wn(n,t);const r=t.concat();return r.sort(n)}function Ln(n,t){if(1===arguments.length)return t=>Ln(n,t);const r=t.concat();return r.sort((t,r)=>{const e=n(t),u=n(r);return e<u?-1:e>u?1:0})}function qn(n,t){return 1===arguments.length?t=>qn(n,t):t.split(n)}function In(n,t){if(1===arguments.length)return t=>In(n,t);const r=n>1?n:1,e=[];let u=0;while(u<t.length)e.push(t.slice(u,u+=r));return e}function Dn(n,t){return 1===arguments.length?t=>Dn(n,t):t.startsWith(n)}function Rn(n,t){return 1===arguments.length?t=>Rn(n,t):n-t}function zn(){return!0}function Jn(n){return S(1,n)}function Mn(n,t){return 1===arguments.length?t=>Mn(n,t):"string"===typeof t?t.slice(0,n):V(t,0,n)}function Tn(n,t){if(1===arguments.length)return t=>Tn(n,t);const r=t.length;let e=n>r?r:n;return"string"===typeof t?t.slice(r-e):(e=r-e,V(t,e,r))}function Gn(n,t){return 1===arguments.length?t=>Gn(n,t):(n(t),t)}function Hn(n,t){return 1===arguments.length?t=>Hn(n,t):-1!==t.search(n)}function Kn(n,t){return 1===arguments.length?t=>Kn(n,t):I(n,_n(0,t))}function Qn(n){return n.toLowerCase()}function Vn(n){return n.toString()}function Xn(n){return n.toUpperCase()}function Yn(n){return n.trim()}function Zn(n){let t=-1;const r=[];while(++t<n.length){const e=n[t];k(e,r)||r.push(e)}return r}function nt(n,t){if(1===arguments.length)return t=>nt(n,t);let r=-1;t.length;const e=[];while(++r<t.length){const u=t[r],i=l(t=>n(u,t),e);i||e.push(u)}return e}function tt(n,t,r){if(void 0===t)return(t,r)=>tt(n,t,r);if(void 0===r)return r=>tt(n,t,r);const e=r.concat();return e.fill(t,n,n+1)}function rt(n){const t=[];for(const r in n)t.push(n[r]);return t}function et(n,t){return En((t,r)=>k(r,n)?t:t.concat(r),[],t)}function ut(n,t){return 1===arguments.length?t=>ut(n,t):u(En)((n,r,e)=>t[e]?n.concat([[r,t[e]]]):n,[],n)}function it(n,t){return 1===arguments.length?t=>it(n,t):n.reduce((n,r,e)=>{return n[r]=t[e],n},{})}},5302:function(n,t,r){"use strict";r.d(t,"a",function(){return i}),r.d(t,"b",function(){return o}),r.d(t,"c",function(){return c});var e=r("42ff"),u=function(n){return n||""},i=e.curry(function(n,t,r){return u(r).length>n?u(r).slice(0,n)+t:u(r)}),o=function(n){return Intl.NumberFormat("pt-BR",{minimumFractionDigits:2,maximumFractionDigits:2}).format(n)},c=function(n){if(!n)return n;if(n.length<10)return n.slice(0,Math.ceil(n.length/2))+"-"+n.slice(Math.ceil(n.length/2));var t=n.slice(0,2),r=n.length>10,e=n.slice(2,r?7:6),u=n.slice(r?6:7);return"(".concat(t,") ").concat(e,"-").concat(u)}},"974d":function(n,t,r){"use strict";r.r(t);var e=function(){var n=this,t=n.$createElement,r=n._self._c||t;return r("page",[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-sm-4 col-md-6"},[r("h1",[n._v(n._s(n.$t("pages.users")))])]),r("div",{staticClass:"col-12 col-sm-8 col-md-6 text-center text-md-right mb-2 mb-md-0"},[r("router-link",{staticClass:"btn btn-info mr-2",attrs:{to:{name:"trashedUsers"}}},[n._v("Usuários Apagados")]),r("router-link",{staticClass:"btn btn-primary mr-2",attrs:{to:{name:"createUsers"}}},[n._v("Cadastrar")])],1)]),r("div",{staticClass:"card shadow"},[r("div",{staticClass:"card-body p-0"},[r("list",{ref:"vuetable",attrs:{"has-actions":"",url:"/api/users",fields:n.fields},scopedSlots:n._u([{key:"actions",fn:function(t){var e=t.rowData;return r("div",{},[r("button",{staticClass:"btn btn-danger",on:{click:function(t){n.dropUser(e)}}},[n._v("Apagar\n                    ")])])}}])})],1)])])},u=[],i=(r("1940"),r("35ca"),r("5231")),o=r("5302"),c={name:"Users",components:{List:i["a"]},meta:{title:$t("pages.users")},data:function(){return{fields:[{name:"name",sortField:"name",title:$t("labels.name")},{name:"email",sortField:"email",title:$t("labels.email")},{name:"phone",sortField:"phone",title:$t("labels.phone"),formatter:o["c"]}]}},methods:{dropUser:function(n){var t=this;this.$mutate("deleteUser",{user:n,onSuccess:function(){return t.$refs.vuetable.reload()}})}}},f=c,l=r("2877"),s=Object(l["a"])(f,e,u,!1,null,null,null);s.options.__file="index.vue";t["default"]=s.exports}}]);
//# sourceMappingURL=users.f1a61161.js.map