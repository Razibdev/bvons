(self["webpackChunk"] = self["webpackChunk"] || []).push([["vendor_gmlo89_datatable_resources_js_app_js"],{

/***/ "./node_modules/laravel-mix/node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    urlCreate: String,
    urlApi: String,
    headers: Array,
    actions: Array
  },
  data: function data() {
    return {
      search: null,
      headers_: [],
      data_: [],
      pagination: {},
      loading: true,
      totalData_: 0,
      has_filters: false,
      filters: {},
      checking: undefined,
      checking_key: null,
      selected: []
    };
  },
  watch: {
    pagination: {
      handler: function handler() {
        this.fetchData();
      },
      deep: true
    },
    search: {
      handler: function handler() {
        this.searchData();
      },
      deep: true
    },
    headers: {
      handler: function handler() {
        this.updateHeaders();
      },
      deep: true
    }
  },
  mounted: function mounted() {
    this.fetchData();

    if (this.$attrs['checking'] !== undefined) {
      this.checking = true;
      this.checking_key = this.$attrs['checking'];
    }
  },
  created: function created() {
    this.updateHeaders();
  },
  methods: {
    searchData: _.debounce(function (next) {
      this.fetchData();
    }, 500),
    existSlot: function existSlot(name) {
      return !!this.$slots[name];
    },
    getValue: function getValue(object, attribute) {
      return attribute.split('.').reduce(function (prev, curr) {
        return prev ? prev[curr] : null;
      }, object || self);
    },
    updateHeaders: function updateHeaders() {
      var el = this;
      el.headers_ = [];

      _.forEach(this.headers, function (item) {
        if (item.sortable == undefined) {
          item.sortable = false;
        }

        el.headers_.push(item);
      });

      this.has_filters = _.filter(this.headers_, ['has_filter', true]).length > 0;

      _.forEach(this.headers_, function (o) {
        if (o.has_filter == true) {
          o.filter = null;
        }
      });
    },
    downloadExcel: function downloadExcel() {
      var el = this;
      axios({
        url: el.urlApi,
        method: 'GET',
        responseType: 'blob',
        // important
        params: {
          query: el.search,
          headers: el.headers_,
          pagination: el.pagination,
          excel: true
        }
      }).then(function (response) {
        var url = window.URL.createObjectURL(new Blob([response.data]));
        var link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'file.xlsx');
        document.body.appendChild(link);
        link.click();
      });
    },
    fetchData: function fetchData() {
      if (!this.urlApi) {
        this.loading = false;
        return true;
      }

      var el = this;
      el.data_ = [];
      axios.get(el.urlApi, {
        params: {
          query: el.search,
          headers: el.headers_,
          pagination: el.pagination
        }
      }).then(function (response) {
        el.data_ = response.data.items;
        el.totalData_ = response.data.total;
      })["finally"](function () {
        el.loading = false;
      });
    },
    changeSort: function changeSort(column, sortable) {
      if (!sortable) return true;

      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending;
      } else {
        this.pagination.sortBy = column;
        this.pagination.descending = false;
      }
    },
    toggleAll: function toggleAll() {
      if (this.selected.length) this.selected = [];else this.selected = this.data_.slice();
    },
    bindAction: function bindAction(action) {
      var el = this;

      if (action.confirmText != undefined) {
        Swal.fire({
          title: action.text,
          text: action.confirmText,
          type: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          cancelButtonText: 'Salir',
          confirmButtonText: 'Aceptar',
          buttonsStyling: false,
          customClass: {
            confirmButton: 'btn btn-outline-danger',
            cancelButton: 'btn btn-default'
          },
          showLoaderOnConfirm: true
        }).then(function (result) {
          if (result.value) {
            el.showLoader();
            axios.post(action.url, {
              selected: el.selected
            }).then(function (response) {
              el.hideLoader();
              el.fetchData();
              Swal.fire('¡Muy bien!', response.data.message, 'success');
            })["catch"](function (error) {
              el.hideLoader();
              var message = 'Ocurrio un error, por favor válida tus datos.';

              if (error.response.status == 400) {
                message = error.response.data.message;
              }

              Swal.fire('¡Ups!', message, 'error');
            });
          }
        });
      }
    }
  }
});

/***/ }),

/***/ "./vendor/gmlo89/datatable/resources/js/app.js":
/*!*****************************************************!*\
  !*** ./vendor/gmlo89/datatable/resources/js/app.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

Vue.component('admin-table', __webpack_require__(/*! ./components/DataTable.vue */ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue")["default"]);

/***/ }),

/***/ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue":
/*!***********************************************************************!*\
  !*** ./vendor/gmlo89/datatable/resources/js/components/DataTable.vue ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DataTable.vue?vue&type=template&id=39b73340& */ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340&");
/* harmony import */ var _DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DataTable.vue?vue&type=script&lang=js& */ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__.render,
  _DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/gmlo89/datatable/resources/js/components/DataTable.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/laravel-mix/node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./DataTable.vue?vue&type=script&lang=js& */ "./node_modules/laravel-mix/node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340&":
/*!******************************************************************************************************!*\
  !*** ./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340& ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DataTable_vue_vue_type_template_id_39b73340___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./DataTable.vue?vue&type=template&id=39b73340& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340&":
/*!*********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./vendor/gmlo89/datatable/resources/js/components/DataTable.vue?vue&type=template&id=39b73340& ***!
  \*********************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "v-toolbar",
        { attrs: { flat: "", color: "white" } },
        [
          _c("v-toolbar-title", [_vm._t("title")], 2),
          _vm._v(" "),
          _c("v-spacer"),
          _vm._v(" "),
          _c("v-text-field", {
            attrs: {
              "append-icon": "search",
              label: "Buscar",
              "single-line": "",
              "hide-details": "",
            },
            model: {
              value: _vm.search,
              callback: function ($$v) {
                _vm.search = $$v
              },
              expression: "search",
            },
          }),
          _vm._v(" "),
          _vm._t("actions"),
          _vm._v(" "),
          _vm.urlCreate
            ? [
                _c("v-spacer"),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "btn btn-outline-primary btn-sm float-right",
                    attrs: { href: _vm.urlCreate },
                  },
                  [
                    _c("i", { staticClass: "fas fa-plus-circle" }),
                    _vm._v(" "),
                    _c("span", { staticClass: "btn-inner--text" }, [
                      _vm._v("Nueva"),
                    ]),
                  ]
                ),
              ]
            : _vm._e(),
        ],
        2
      ),
      _vm._v(" "),
      _vm.actions != undefined && _vm.selected.length > 0
        ? _c("div", { staticClass: "row justify-content-md-center mb-10" }, [
            _c(
              "div",
              { staticClass: "col-md-auto" },
              _vm._l(_vm.actions, function (action) {
                return _c(
                  "button",
                  {
                    key: action.text,
                    class: action.class,
                    on: {
                      click: function ($event) {
                        return _vm.bindAction(action)
                      },
                    },
                  },
                  [
                    action.icon.length > 0
                      ? _c("span", { class: action.icon })
                      : _vm._e(),
                    _vm._v("\n          " + _vm._s(action.text) + "\n        "),
                  ]
                )
              }),
              0
            ),
          ])
        : _vm._e(),
      _vm._v(" "),
      _c("v-data-table", {
        staticClass: "elevation-1",
        attrs: {
          headers: _vm.headers_,
          items: _vm.data_,
          pagination: _vm.pagination,
          "total-items": _vm.totalData_,
          loading: _vm.loading,
          "select-all": _vm.checking,
          "item-key": _vm.checking_key,
        },
        on: {
          "update:pagination": function ($event) {
            _vm.pagination = $event
          },
        },
        scopedSlots: _vm._u(
          [
            {
              key: "headers",
              fn: function (props) {
                return [
                  _c(
                    "tr",
                    [
                      _vm.checking
                        ? _c(
                            "th",
                            [
                              _c("v-checkbox", {
                                attrs: {
                                  "input-value": props.all,
                                  indeterminate: props.indeterminate,
                                  primary: "",
                                  "hide-details": "",
                                },
                                on: {
                                  click: function ($event) {
                                    $event.stopPropagation()
                                    return _vm.toggleAll.apply(null, arguments)
                                  },
                                },
                              }),
                            ],
                            1
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm._l(props.headers, function (header) {
                        return _c(
                          "th",
                          {
                            key: header.text,
                            class: [
                              header.sortable ? "column sortable" : "",
                              _vm.pagination.descending ? "desc" : "asc",
                              header.value === _vm.pagination.sortBy
                                ? "active"
                                : "",
                            ],
                            on: {
                              click: function ($event) {
                                _vm.changeSort(
                                  header.value,
                                  header.sortable && !header.has_filter
                                )
                              },
                            },
                          },
                          [
                            header.sortable
                              ? _c("v-icon", { attrs: { small: "" } }, [
                                  _vm._v("arrow_upward"),
                                ])
                              : _vm._e(),
                            _vm._v(" "),
                            header.sortable && header.has_filter
                              ? _c(
                                  "button",
                                  {
                                    staticClass: "btn btn-default",
                                    on: {
                                      click: function ($event) {
                                        return _vm.changeSort(
                                          header.value,
                                          true
                                        )
                                      },
                                    },
                                  },
                                  [_c("i", { staticClass: "fas fa-sort" })]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            !header.has_filter
                              ? _c("span", [_vm._v(_vm._s(header.text))])
                              : _vm._e(),
                            _vm._v(" "),
                            header.has_filter
                              ? _vm._t("filter_" + header.value, null, {
                                  update: _vm.fetchData,
                                  header: header,
                                })
                              : _vm._e(),
                          ],
                          2
                        )
                      }),
                    ],
                    2
                  ),
                ]
              },
            },
            {
              key: "items",
              fn: function (props) {
                return [
                  _c(
                    "tr",
                    {
                      attrs: { active: props.selected },
                      on: {
                        click: function ($event) {
                          props.selected = !props.selected
                        },
                      },
                    },
                    [
                      _vm.checking
                        ? _c(
                            "td",
                            [
                              _c("v-checkbox", {
                                attrs: {
                                  "input-value": props.selected,
                                  primary: "",
                                  "hide-details": "",
                                },
                              }),
                            ],
                            1
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm._l(_vm.headers_, function (item) {
                        return _c("td", { key: item.value }, [
                          !item.slot
                            ? _c("span", [
                                _vm._v(
                                  "\n                  " +
                                    _vm._s(
                                      _vm.getValue(props.item, item.value)
                                    ) +
                                    "\n                "
                                ),
                              ])
                            : _c(
                                "span",
                                [_vm._t(item.slot, null, { item: props.item })],
                                2
                              ),
                        ])
                      }),
                    ],
                    2
                  ),
                ]
              },
            },
            {
              key: "no-data",
              fn: function () {
                return [
                  _c("p", { staticClass: "text-center text-muted" }, [
                    _vm._v(
                      "\n            - No se encontró información para mostrar -\n          "
                    ),
                  ]),
                ]
              },
              proxy: true,
            },
            {
              key: "no-results",
              fn: function () {
                return [
                  _c("p", { staticClass: "text-center text-muted" }, [
                    _vm._v(
                      '\n            - No se encontró información que coincida con "'
                    ),
                    _c("strong", [_vm._v(_vm._s(_vm.search))]),
                    _vm._v('" -\n          '),
                  ]),
                  _vm._v(" "),
                  _c(
                    "v-alert",
                    { attrs: { value: true, color: "error", icon: "warning" } },
                    [
                      _vm._v(
                        '\n            Your search for "' +
                          _vm._s(_vm.search) +
                          '" found no results.\n          '
                      ),
                    ]
                  ),
                ]
              },
              proxy: true,
            },
          ],
          null,
          true
        ),
        model: {
          value: _vm.selected,
          callback: function ($$v) {
            _vm.selected = $$v
          },
          expression: "selected",
        },
      }),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);