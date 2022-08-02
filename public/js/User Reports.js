"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[68],{6236:(t,e,s)=>{s.r(e),s.d(e,{default:()=>c});var n=s(629);function r(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,n)}return s}function a(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?r(Object(s),!0).forEach((function(e){o(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):r(Object(s)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}function o(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}const i={props:{attendees:{type:Array,required:!0},absentees:{type:Array,required:!0},defaulters:{type:Array,required:!0}},data:function(){return{pagination:{page:1,max:15},search:"",loading:!0}},computed:a(a({},(0,n.Se)(["allUsers","allShifts"])),{},{users:function(){var t=this.$route.params.type;return"attendees"===t?this.attendees:"absentees"===t?this.absentees:this.defaulters}}),mounted:function(){var t=this;this.$nextTick((function(){t.loading=!1}))},methods:{formatDate:function(t){return null===t?" ----- ":new Date(Date.parse(t)).toLocaleDateString("en-US",{weekday:"long",day:"2-digit",month:"long",year:"numeric",hour12:!0,hour:"2-digit",minute:"numeric"})}}};const c=(0,s(1900).Z)(i,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[t.loading?s("div",{staticClass:"d-flex flex-row align-items-center justify-content-center p-4"},[t._m(0)]):s("div",[0===t.allUsers.length?s("div",{staticClass:"p-3 m-2"},[t._v("\n            No users yet\n        ")]):s("div",[s("h6",[t._v("\n                Click on a user to view attendance history\n            ")]),t._v(" "),s("vs-table",{key:t.users.length,scopedSlots:t._u([{key:"header",fn:function(){return[s("vs-input",{attrs:{block:"",border:"",danger:"",placeholder:"Search"},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})]},proxy:!0},{key:"thead",fn:function(){return[s("vs-tr",{staticClass:"text-capitalize"},[s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Avatar")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Name")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("From")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Phone Number")])]),t._v(" "),s("vs-th",{attrs:{sort:""},on:{click:function(e){t.users=t.$vs.sortData(e,t.users,"shift_id")}}},[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Shift")])])],1)]},proxy:!0},{key:"tbody",fn:function(){return t._l(t.$vs.getPage(t.$vs.getSearch(t.users,t.search),t.pagination.page,t.pagination.max),(function(e,n){return s("vs-tr",{key:n,scopedSlots:t._u([{key:"expand",fn:function(){return[s("div",{staticClass:"container py-3 bg-light shadow border rounded-3"},[s("h6",{staticClass:"fw-bold"},[s("i",{staticClass:"fa-duotone fa-clock-rotate-left"}),t._v("\n                                    Attendance History\n                                ")]),t._v(" "),s("vs-table",{scopedSlots:t._u([{key:"thead",fn:function(){return[s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("#")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Session")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Clocked In")])]),t._v(" "),s("vs-th",[s("h6",{staticClass:"m-0 mx-auto fw-bold"},[t._v("Clocked Out")])])]},proxy:!0},{key:"tbody",fn:function(){return t._l(e.attendances,(function(n,r){return s("vs-tr",{key:r},[s("vs-td",[s("h6",{staticClass:"m-0 text-center"},[t._v("\n                                                    "+t._s(r+1)+"\n                                                ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center"},[t._v("\n                                                    "+t._s(e.shift.sessions.find((function(t){return t.id===n.session_id})).name)+"\n                                                ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center"},[t._v("\n                                                    "+t._s(t.formatDate(n.start))+"\n                                                ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center"},[t._v("\n                                                    "+t._s(t.formatDate(n.end))+"\n                                                ")])])],1)}))},proxy:!0}],null,!0)})],1)]},proxy:!0}],null,!0)},[s("vs-td",[s("b-avatar",{attrs:{src:"../../../../storage/profile/"+e.profile}})],1),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center mx-auto",staticStyle:{width:"150px",overflow:"hidden","white-space":"nowrap","text-overflow":"ellipsis"}},[t._v("\n                                "+t._s(e.name)+"\n                            ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center mx-auto",staticStyle:{width:"200px",overflow:"hidden","white-space":"nowrap","text-overflow":"ellipsis"}},[t._v("\n                                "+t._s(e.from)+"\n                            ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 p-1 text-center mx-auto",staticStyle:{width:"250px",overflow:"hidden","white-space":"nowrap","text-overflow":"ellipsis"}},[t._v("\n                                "+t._s(e.phone_number)+"\n                            ")])]),t._v(" "),s("vs-td",[s("h6",{staticClass:"m-0 text-center mx-auto"},[t._v("\n                                "+t._s(t.allShifts.find((function(t){return t.id===e.shift_id})).name)+"\n                            ")])])],1)}))},proxy:!0},{key:"footer",fn:function(){return[s("vs-pagination",{attrs:{color:"dark",length:t.$vs.getLength(t.users,t.pagination.max)},model:{value:t.pagination.page,callback:function(e){t.$set(t.pagination,"page",e)},expression:"pagination.page"}})]},proxy:!0}])})],1)])])}),[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"spinner-border spinner-border-sm",staticStyle:{height:"100px",width:"100px"},attrs:{role:"status"}},[s("span",{staticClass:"visually-hidden"},[t._v("Loading...")])])}],!1,null,null,null).exports},1900:(t,e,s)=>{function n(t,e,s,n,r,a,o,i){var c,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=s,l._compiled=!0),n&&(l.functional=!0),a&&(l._scopeId="data-v-"+a),o?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},l._ssrRegister=c):r&&(c=i?function(){r.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:r),c)if(l.functional){l._injectStyles=c;var u=l.render;l.render=function(t,e){return c.call(e),u(t,e)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:l}}s.d(e,{Z:()=>n})}}]);
//# sourceMappingURL=User Reports.js.map