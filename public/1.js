(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{11:function(t,e,i){var s=i(34);"string"==typeof s&&(s=[[t.i,s,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};i(5)(s,n);s.locals&&(t.exports=s.locals)},14:function(t,e,i){"use strict";i.r(e);var s=i(2),n={props:["name","link","icon","description"]},a=i(0),l={components:{menuItem:Object(a.a)(n,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"column"},[i("inertia-link",{attrs:{href:t.link}},[i("div",{staticClass:"box hover-box"},[i("article",{staticClass:"media"},[i("div",{staticClass:"media-left"},[i("b-icon",{attrs:{icon:t.icon,size:"is-large"}})],1),t._v(" "),i("div",{staticClass:"media-content"},[i("div",{staticClass:"content"},[i("p",[i("strong",[t._v(t._s(t.name))]),t._v(" "),i("br"),t._v("\n                            "+t._s(t.description)+"\n                        ")])])])])])])],1)}),[],!1,null,null,null).exports},data:function(){return{menu:[{id:1,icon:"devices",name:"Устройства",link:this.route("dashboard.devices"),description:"Список ваших устройств онлайна и настроек"},{id:2,icon:"account",name:"Профиль",link:this.route("dashboard.profile"),description:"Редактирование профиля пользователя, генерация токена и др."},{id:3,icon:"message-alert",name:"События",link:this.route("dashboard.profile"),description:"Все события которые происходили с вашими устройствами"}]}}},o=(i(33),Object(a.a)(l,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"columns my-1 is-multiline"},this._l(this.menu,(function(t){return e("menu-item",{key:t.id,attrs:{icon:t.icon,name:t.name,description:t.description,link:t.link}})})),1)}),[],!1,null,null,null).exports),r={props:["title"],components:{layout:s.a,profileMenu:o},metaInfo:function(){return{title:this.title}}},c=Object(a.a)(r,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("layout",{attrs:{hero:!0},scopedSlots:t._u([{key:"hero",fn:function(){return[i("h1",{staticClass:"title"},[t._v("Личный кабинет")]),t._v(" "),i("h2",{staticClass:"subtitle"},[t._v(t._s(t.$page.props.user.name)+" #"+t._s(t.$page.props.user.id))])]},proxy:!0}])},[t._v(" "),i("nav",{staticClass:"level my-2"},[i("div",{staticClass:"level-item has-text-centered"},[i("div",[i("p",{staticClass:"heading"},[t._v("Устройств")]),t._v(" "),i("p",{staticClass:"title"},[t._v("5")])])]),t._v(" "),i("div",{staticClass:"level-item has-text-centered"},[i("div",[i("p",{staticClass:"heading"},[t._v("Событий")]),t._v(" "),i("p",{staticClass:"title"},[t._v("5,273 "),i("span",{staticClass:"has-text-danger"},[t._v("+5")])])])])]),t._v(" "),i("profile-menu")],1)}),[],!1,null,null,null);e.default=c.exports},33:function(t,e,i){"use strict";i(11)},34:function(t,e,i){(t.exports=i(4)(!1)).push([t.i,".column{min-width:300px}",""])}}]);