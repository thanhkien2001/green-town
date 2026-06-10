/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************************************!*\
  !*** ./platform/packages/plugin-management/resources/assets/js/plugin.js ***!
  \***************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var PluginManagement = /*#__PURE__*/function () {
  function PluginManagement() {
    _classCallCheck(this, PluginManagement);
  }
  return _createClass(PluginManagement, [{
    key: "init",
    value: function init() {
      var _this = this;
      $(document).on('click', '.btn-trigger-remove-plugin', function (event) {
        event.preventDefault();
        $('#confirm-remove-plugin-button').data('plugin', $(event.currentTarget).data('plugin'));
        $('#remove-plugin-modal').modal('show');
      });
      $(document).on('click', '#confirm-remove-plugin-button', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        var $modal = $('#remove-plugin-modal');
        $.ajax({
          url: route('plugins.remove', {
            plugin: _self.data('plugin')
          }),
          type: 'POST',
          data: {
            _method: 'DELETE'
          },
          success: function success(data) {
            if (data.error) {
              Botble.showError(data.message);
            } else {
              Botble.showSuccess(data.message);
              window.location.reload();
            }
            _self.removeClass('button-loading');
            $modal.modal('hide');
          },
          error: function error(data) {
            Botble.handleError(data);
            _self.removeClass('button-loading');
            $modal.modal('hide');
          }
        });
      });
      $(document).on('click', '.btn-trigger-update-plugin', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var uuid = _self.data('uuid');
        var name = _self.data('name');
        _self.addClass('button-loading');
        _self.attr('disabled', true);
        $.ajax({
          url: route('plugins.marketplace.ajax.update', {
            id: uuid,
            name: name
          }),
          type: 'POST',
          success: function success(data) {
            if (data.error) {
              Botble.showError(data.message);
              _self.removeClass('button-loading');
              _self.removeAttr('disabled', true);
              if (data.data && data.data.redirect) {
                window.location.href;
              }
            } else {
              Botble.showSuccess(data.message);
              setTimeout(function () {
                window.location.reload();
              }, 2000);
            }
          },
          error: function error(data) {
            Botble.handleError(data);
            _self.removeClass('button-loading');
            _self.removeAttr('disabled', true);
          }
        });
      });
      $(document).on('click', '.btn-trigger-change-status', /*#__PURE__*/function () {
        var _ref = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2(event) {
          var _self, pluginName;
          return _regenerator().w(function (_context2) {
            while (1) switch (_context2.n) {
              case 0:
                event.preventDefault();
                _self = $(event.currentTarget);
                _self.addClass('button-loading');
                pluginName = _self.data('plugin');
                if (!(_self.data('status') === 1)) {
                  _context2.n = 2;
                  break;
                }
                _context2.n = 1;
                return _this.activateOrDeactivatePlugin(pluginName);
              case 1:
                return _context2.a(2);
              case 2:
                $.ajax({
                  url: route('plugins.check-requirement', {
                    name: pluginName
                  }),
                  type: 'POST',
                  success: function () {
                    var _success = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(response) {
                      var error, data, message, $modal;
                      return _regenerator().w(function (_context) {
                        while (1) switch (_context.n) {
                          case 0:
                            error = response.error, data = response.data, message = response.message;
                            if (!error) {
                              _context.n = 2;
                              break;
                            }
                            if (!(data && data.existing_plugins_on_marketplace)) {
                              _context.n = 1;
                              break;
                            }
                            $modal = $('#confirm-install-plugin-modal');
                            $modal.find('.modal-body #requirement-message').html(message);
                            $modal.find('input[name="plugin_name"]').val(pluginName);
                            $modal.find('input[name="ids"]').val(data.existing_plugins_on_marketplace);
                            $modal.modal('show');
                            _self.removeClass('button-loading');
                            return _context.a(2);
                          case 1:
                            Botble.showError(message);
                            _context.n = 3;
                            break;
                          case 2:
                            _context.n = 3;
                            return _this.activateOrDeactivatePlugin(pluginName);
                          case 3:
                            _self.removeClass('button-loading');
                          case 4:
                            return _context.a(2);
                        }
                      }, _callee);
                    }));
                    function success(_x2) {
                      return _success.apply(this, arguments);
                    }
                    return success;
                  }(),
                  error: function error(_error) {
                    Botble.handleError(_error);
                    _self.removeClass('button-loading');
                  }
                });
              case 3:
                return _context2.a(2);
            }
          }, _callee2);
        }));
        return function (_x) {
          return _ref.apply(this, arguments);
        };
      }());
      $(document).on('click', '#confirm-install-plugin-button', /*#__PURE__*/function () {
        var _ref2 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3(event) {
          var _self, $body, pluginName, pluginIds, activatedPlugins, _iterator, _step, pluginId, response, _i, _activatedPlugins, _pluginName, _t;
          return _regenerator().w(function (_context3) {
            while (1) switch (_context3.p = _context3.n) {
              case 0:
                _self = $(event.currentTarget);
                _self.addClass('button-loading');
                $body = _self.parent().parent();
                pluginName = $body.find('input[name="plugin_name"]').val();
                pluginIds = $body.find('input[name="ids"]').val();
                activatedPlugins = [];
                _iterator = _createForOfIteratorHelper(pluginIds.split(','));
                _context3.p = 1;
                _iterator.s();
              case 2:
                if ((_step = _iterator.n()).done) {
                  _context3.n = 5;
                  break;
                }
                pluginId = _step.value;
                _context3.n = 3;
                return _this.installPlugin(pluginId);
              case 3:
                response = _context3.v;
                if (response) {
                  activatedPlugins.push(response.name);
                }
              case 4:
                _context3.n = 2;
                break;
              case 5:
                _context3.n = 7;
                break;
              case 6:
                _context3.p = 6;
                _t = _context3.v;
                _iterator.e(_t);
              case 7:
                _context3.p = 7;
                _iterator.f();
                return _context3.f(7);
              case 8:
                _i = 0, _activatedPlugins = activatedPlugins;
              case 9:
                if (!(_i < _activatedPlugins.length)) {
                  _context3.n = 11;
                  break;
                }
                _pluginName = _activatedPlugins[_i];
                _context3.n = 10;
                return _this.activateOrDeactivatePlugin(_pluginName, false);
              case 10:
                _i++;
                _context3.n = 9;
                break;
              case 11:
                _context3.n = 12;
                return _this.activateOrDeactivatePlugin(pluginName);
              case 12:
                _self.removeClass('button-loading');
                _self.text(_self.data('text'));
              case 13:
                return _context3.a(2);
            }
          }, _callee3, null, [[1, 6, 7, 8]]);
        }));
        return function (_x3) {
          return _ref2.apply(this, arguments);
        };
      }());
      this.checkUpdate();
    }
  }, {
    key: "checkUpdate",
    value: function checkUpdate() {
      $.ajax({
        url: route('plugins.marketplace.ajax.check-update'),
        type: 'POST',
        success: function success(data) {
          if (!data.data) {
            return;
          }
          Object.keys(data.data).forEach(function (key) {
            var plugin = data.data[key];
            $('button[data-check-update="' + plugin.name + '"]').data('uuid', plugin.id).show();
          });
        }
      });
    }
  }, {
    key: "activateOrDeactivatePlugin",
    value: function () {
      var _activateOrDeactivatePlugin = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee4(pluginName) {
        var reload,
          _args4 = arguments;
        return _regenerator().w(function (_context4) {
          while (1) switch (_context4.n) {
            case 0:
              reload = _args4.length > 1 && _args4[1] !== undefined ? _args4[1] : true;
              _context4.n = 1;
              return $.ajax({
                url: route('plugins.change.status', {
                  name: pluginName
                }),
                type: 'POST',
                data: {
                  _method: 'PUT'
                },
                success: function success(data) {
                  if (!data.error) {
                    Botble.showSuccess(data.message);
                    if (reload) {
                      $('#plugin-list #app-' + pluginName).load(window.location.href + ' #plugin-list #app-' + pluginName + ' > *');
                      window.location.reload();
                    }
                    return;
                  }
                  Botble.showError(data.message);
                },
                error: function error(data) {
                  Botble.handleError(data);
                }
              });
            case 1:
              return _context4.a(2);
          }
        }, _callee4);
      }));
      function activateOrDeactivatePlugin(_x4) {
        return _activateOrDeactivatePlugin.apply(this, arguments);
      }
      return activateOrDeactivatePlugin;
    }()
  }, {
    key: "installPlugin",
    value: function () {
      var _installPlugin = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee5(id) {
        var data;
        return _regenerator().w(function (_context5) {
          while (1) switch (_context5.n) {
            case 0:
              data = null;
              _context5.n = 1;
              return $.ajax({
                method: 'POST',
                url: route('plugins.marketplace.ajax.install', {
                  id: id
                }),
                success: function success(response) {
                  return data = response.error ? [] : response.data;
                },
                error: function error(_error2) {
                  Botble.handleError(_error2);
                }
              });
            case 1:
              return _context5.a(2, data);
          }
        }, _callee5);
      }));
      function installPlugin(_x5) {
        return _installPlugin.apply(this, arguments);
      }
      return installPlugin;
    }()
  }]);
}();
$(document).ready(function () {
  new PluginManagement().init();
});
/******/ })()
;