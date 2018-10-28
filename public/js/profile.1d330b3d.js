(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["profile"],{ab2e:function(e,t,a){"use strict";var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("div",{staticClass:"form-group"},[a("label",[e._t("default")],2),a("input",{staticClass:"form-control",attrs:{type:"file",accept:"image/*",name:e.name,id:e.name},on:{change:e.generatePreview}})]),a("div",{directives:[{name:"show",rawName:"v-show",value:e.imgSrc,expression:"imgSrc"}],staticClass:"m-2"},[a("img",{staticClass:"img-response img-fluid img-thumbnail",style:e.imgStyle,attrs:{src:e.imgSrc,alt:"Preview "+e.name}})])])},n=[],i=(a("96cf"),a("3040")),s=a("c665"),o=a("aa9a"),c=function(){function e(){Object(s["a"])(this,e),this.reader=new FileReader}return Object(o["a"])(e,[{key:"readAs",value:function(e,t){var a=this;return new Promise(function(r,n){var i="readAs".concat(t);try{a.reader.onload=function(e){return r(e.target.result)},a.reader[i](e)}catch(e){return n(e)}})}},{key:"readAsDataURL",value:function(e){return this.readAs(e,"DataURL")}},{key:"readAsArrayBuffer",value:function(e){return this.readAs(e,"ArrayBuffer")}},{key:"readAsBinaryString",value:function(e){this.readAs(e,"BinaryString")}},{key:"readAsText",value:function(e){this.readAs("Text")}}]),e}(),u={name:"ImageInput",props:{src:{required:!0},name:{type:String,default:function(){return"image"}},imgStyle:{type:[Object,String],default:function(){return{}}}},data:function(){return{imageFile:null,imagePreview:null}},computed:{imgSrc:function(){return this.imagePreview?this.imagePreview:this.src}},methods:{generatePreview:function(){var e=Object(i["a"])(regeneratorRuntime.mark(function e(t){var a,r,n;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,a=t.target.files[0],r=new c,e.next=5,r.readAsDataURL(a);case 5:n=e.sent,this.$data.imageFile=a,this.$data.imagePreview=n,this.$emit("change",a),e.next=14;break;case 11:e.prev=11,e.t0=e["catch"](0),unknownError();case 14:case"end":return e.stop()}},e,this,[[0,11]])}));return function(t){return e.apply(this,arguments)}}()}},l=u,m=a("2877"),d=Object(m["a"])(l,r,n,!1,null,null,null);d.options.__file="index.vue";t["a"]=d.exports},cb14:function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("page",[a("h1",[e._v("Perfil")]),a("div",{staticClass:"card shadow mb-5"},[a("div",{staticClass:"card-body"},[a("form",{on:{submit:function(t){return t.preventDefault(),e.onSubmit(t)}}},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-12"},[a("image-input",{attrs:{"img-style":{maxWidth:"200px",maxHeight:"200px"},src:e.user.image},on:{change:e.setImage}},[e._v("\n                            Imagem\n                        ")])],1)]),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 col-md-6"},[a("div",{staticClass:"form-group"},[a("label",[e._v("Nome")]),a("input",{staticClass:"form-control",attrs:{type:"text",name:"name"},domProps:{value:e.user.name}})])]),a("div",{staticClass:"col-12 col-md-6"},[a("div",{staticClass:"form-group"},[a("label",[e._v("Email")]),a("input",{staticClass:"form-control",attrs:{type:"text",name:"email"},domProps:{value:e.user.email}})])])]),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 col-md-6"},[a("div",{staticClass:"form-group"},[a("label",[e._v("Telefone")]),a("input",{staticClass:"form-control",attrs:{type:"text",name:"phone"},domProps:{value:e.user.phone||""}})])]),a("div",{staticClass:"col-12 col-md-6"},[a("password-field")],1)]),a("div",{staticClass:"text-right"},[a("router-link",{staticClass:"btn btn-danger mr-1",attrs:{to:"/"}},[e._v("Cancelar")]),a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e._v("Salvar")])],1)])])])])},n=[],i=(a("96cf"),a("3040")),s=a("c93e"),o=a("7a43"),c=a("aeb2"),u=a("2b2b"),l=a("2f62"),m=a("ab2e"),d={name:"Profile",meta:{title:$t("pages.profile")},components:{PasswordField:c["a"],ImageInput:m["a"]},mixins:[o["a"]],data:function(){return{errors:new u["a"],image:null}},watch:{confirming:function(e){$("#updateConfirm").modal({show:e})}},mounted:function(){var e=this;$("#updateConfirm").on("hidden.bs.modal",function(){return e.$data.confirming=!1}),$("#updateConfirm").on("shown.bs.modal",function(){return e.$data.confirming=!0})},notifications:{showUpdateErrorNotification:{type:"error",title:$t("notifications.title.error"),message:$t("notifications.message.user.update.error")}},methods:Object(s["a"])({},Object(l["b"])({verifyPassword:"auth/verifyPassword",updateUser:"auth/updateUser"}),{onSubmit:function(){var e=Object(i["a"])(regeneratorRuntime.mark(function e(t){var a,r,n;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return t.preventDefault(),a=new FormData(t.target),e.next=4,this.verifyPassword();case 4:if(r=e.sent,!r){e.next=10;break}return e.next=8,this.updateUser(a);case 8:n=e.sent,n.hasOwnProperty("errors")&&(this.$data.errors=new u["a"](n.errors));case 10:return e.abrupt("return",!1);case 11:case"end":return e.stop()}},e,this)}));return function(t){return e.apply(this,arguments)}}(),setImage:function(e){this.$data.image=e}})},f=d,p=a("2877"),v=Object(p["a"])(f,r,n,!1,null,null,null);v.options.__file="index.vue";t["default"]=v.exports}}]);
//# sourceMappingURL=profile.1d330b3d.js.map