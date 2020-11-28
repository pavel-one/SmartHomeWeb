(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/profile.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/profile.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Layout_default__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Layout/default */ "./resources/js/Layout/default.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['title', 'errors'],
  components: {
    layout: _Layout_default__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  metaInfo: function metaInfo() {
    return {
      title: this.title
    };
  },
  data: function data() {
    return {
      isCopy: false,
      form: {
        email: this.$page.props.user.email,
        name: this.$page.props.user.name,
        password: '',
        token: this.$page.props.user.token
      }
    };
  },
  methods: {
    remove: function remove() {
      var _this = this;

      this.$buefy.dialog.confirm({
        message: 'Внимание! Вы точно хотите удалить свой профиль и все связанные с ним данные? После подтверждения, восстановить их будет невозможно!',
        onConfirm: function onConfirm() {
          _this.$inertia["delete"](_this.route('dashboard.delete'));
        },
        cancelText: 'Закрыть'
      });
    },
    submit: function submit() {
      var _this2 = this;

      if (this.form.password) {
        this.$buefy.dialog.confirm({
          message: 'Ваш пароль будет изменен на новый, вы уверены? Если вы не хотите менять пароль, вернитесь назад и очистите поле "новый пароль"',
          onConfirm: function onConfirm() {
            _this2.$inertia.post(_this2.route('dashboard.update'), _this2.form);
          },
          cancelText: 'Закрыть'
        });
      } else {
        this.$inertia.post(this.route('dashboard.update'), this.form);
      }
    },
    copy: function copy() {
      if (this.isCopy) {
        return;
      }

      this.copyToClipboard(this.$page.props.user.token);
      this.$buefy.notification.open({
        duration: 2000,
        message: 'Скопировано',
        position: 'is-top-right',
        type: 'is-success',
        hasIcon: true
      });
    },
    token: function token() {
      var _this3 = this;

      this.$buefy.dialog.confirm({
        message: 'Внимание! Будет сгенерирован новый токен, а это значит что все ваши устройства работающие сейчас, работать перестанут, продолжить?',
        onConfirm: function onConfirm() {
          _this3.$inertia.get(_this3.route('dashboard.token'));
        },
        cancelText: 'Закрыть'
      });
    },
    copyToClipboard: function copyToClipboard(str) {
      var el = document.createElement('textarea');
      el.value = str;
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
      this.isCopy = true;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0&":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0& ***!
  \*****************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "layout",
    {
      attrs: { hero: true },
      scopedSlots: _vm._u([
        {
          key: "hero",
          fn: function() {
            return [
              _c("h1", { staticClass: "title" }, [
                _vm._v("Редактировать профиль")
              ]),
              _vm._v(" "),
              _c("h2", { staticClass: "subtitle" }, [
                _vm._v(_vm._s(_vm.$page.props.user.name))
              ])
            ]
          },
          proxy: true
        }
      ])
    },
    [
      _vm._v(" "),
      _c("p", { staticClass: "py-3" }, [
        _vm._v("Вы можете изменить данные своего профиля или удалить его.")
      ]),
      _vm._v(" "),
      _c(
        "form",
        {
          staticClass: "my-3",
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.submit($event)
            }
          }
        },
        [
          _c(
            "b-field",
            {
              attrs: {
                type: _vm.errors.name ? "is-danger" : "",
                message: _vm.errors.name,
                "label-position": "on-border",
                label: "Имя"
              }
            },
            [
              _c("b-input", {
                attrs: { type: "text", maxlength: "30" },
                model: {
                  value: _vm.form.name,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "name", $$v)
                  },
                  expression: "form.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-field",
            {
              attrs: {
                type: _vm.errors.email ? "is-danger" : "",
                message: _vm.errors.email,
                "label-position": "on-border",
                label: "Email"
              }
            },
            [
              _c("b-input", {
                attrs: { type: "email", maxlength: "30" },
                model: {
                  value: _vm.form.email,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "email", $$v)
                  },
                  expression: "form.email"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-field",
            {
              attrs: {
                type: _vm.errors.token ? "is-danger" : "",
                message: _vm.errors.token,
                "label-position": "on-border",
                label: "Токен"
              }
            },
            [
              _c("b-input", {
                attrs: { disabled: "true", type: "text" },
                model: {
                  value: _vm.form.token,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "token", $$v)
                  },
                  expression: "form.token"
                }
              }),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "buttons" },
                [
                  _c(
                    "b-button",
                    {
                      attrs: { type: "is-primary is-light" },
                      on: { click: _vm.token }
                    },
                    [_c("b-icon", { attrs: { icon: "refresh" } })],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      attrs: {
                        disabled: _vm.isCopy,
                        type: "is-primary is-light"
                      },
                      on: { click: _vm.copy }
                    },
                    [
                      _c("b-icon", {
                        attrs: { icon: _vm.isCopy ? "check" : "content-copy" }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-field",
            {
              attrs: {
                type: _vm.errors.password ? "is-danger" : "",
                message: _vm.errors.password,
                "label-position": "on-border",
                label: "Новый пароль"
              }
            },
            [
              _c("b-input", {
                attrs: { type: "password" },
                model: {
                  value: _vm.form.password,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "password", $$v)
                  },
                  expression: "form.password"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "buttons" },
            [
              _c(
                "b-button",
                { attrs: { "native-type": "submit", type: "is-primary" } },
                [_vm._v("Сохранить")]
              ),
              _vm._v(" "),
              _c(
                "b-button",
                { attrs: { type: "is-danger" }, on: { click: _vm.remove } },
                [_vm._v("Удалить профиль")]
              )
            ],
            1
          )
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/Pages/profile.vue":
/*!****************************************!*\
  !*** ./resources/js/Pages/profile.vue ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./profile.vue?vue&type=template&id=e2af84a0& */ "./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0&");
/* harmony import */ var _profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./profile.vue?vue&type=script&lang=js& */ "./resources/js/Pages/profile.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Pages/profile.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Pages/profile.vue?vue&type=script&lang=js&":
/*!*****************************************************************!*\
  !*** ./resources/js/Pages/profile.vue?vue&type=script&lang=js& ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./profile.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/profile.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_profile_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0&":
/*!***********************************************************************!*\
  !*** ./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0& ***!
  \***********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./profile.vue?vue&type=template&id=e2af84a0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/profile.vue?vue&type=template&id=e2af84a0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_profile_vue_vue_type_template_id_e2af84a0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);