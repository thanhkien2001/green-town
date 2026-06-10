/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************************!*\
  !*** ./platform/core/setting/resources/assets/js/setting.js ***!
  \**************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var SettingManagement = /*#__PURE__*/function () {
  function SettingManagement() {
    _classCallCheck(this, SettingManagement);
  }
  return _createClass(SettingManagement, [{
    key: "init",
    value: function init() {
      var _this = this;
      this.handleMultipleAdminEmails();
      $('input[data-key=email-config-status-btn]').on('change', function (event) {
        var _self = $(event.currentTarget);
        var key = _self.prop('id');
        var url = _self.data('change-url');
        $.ajax({
          type: 'POST',
          url: url,
          data: {
            key: key,
            value: _self.prop('checked') ? 1 : 0
          },
          success: function success(res) {
            if (!res.error) {
              Botble.showSuccess(res.message);
            } else {
              Botble.showError(res.message);
            }
          },
          error: function error(res) {
            Botble.handleError(res);
          }
        });
      });
      $(document).on('change', '.setting-select-options', function (event) {
        $('.setting-wrapper').addClass('hidden');
        $('.setting-wrapper[data-type=' + $(event.currentTarget).val() + ']').removeClass('hidden');
      });
      $('.send-test-email-trigger-button').on('click', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var defaultText = _self.text();
        _self.text(_self.data('saving'));
        $.ajax({
          type: 'POST',
          url: route('settings.email.edit'),
          data: _self.closest('form').serialize(),
          success: function success(res) {
            if (!res.error) {
              Botble.showSuccess(res.message);
              $('#send-test-email-modal').modal('show');
            } else {
              Botble.showError(res.message);
            }
            _self.text(defaultText);
          },
          error: function error(res) {
            Botble.handleError(res);
            _self.text(defaultText);
          }
        });
      });
      $('#send-test-email-btn').on('click', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          type: 'POST',
          url: route('setting.email.send.test'),
          data: {
            email: _self.closest('.modal-content').find('input[name=email]').val()
          },
          success: function success(res) {
            if (!res.error) {
              Botble.showSuccess(res.message);
            } else {
              Botble.showError(res.message);
            }
            _self.removeClass('button-loading');
            _self.closest('.modal').modal('hide');
          },
          error: function error(res) {
            Botble.handleError(res);
            _self.removeClass('button-loading');
            _self.closest('.modal').modal('hide');
          }
        });
      });
      $('.generate-thumbnails-trigger-button').on('click', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var defaultText = _self.text();
        _self.text(_self.data('saving'));
        $.ajax({
          type: 'POST',
          url: route('settings.media.post'),
          data: _self.closest('form').serialize(),
          success: function success(res) {
            if (!res.error) {
              $('#generate-thumbnails-modal').modal('show');
            } else {
              Botble.showError(res.message);
            }
            _self.text(defaultText);
          },
          error: function error(res) {
            Botble.handleError(res);
            _self.text(defaultText);
          }
        });
      });
      $('#generate-thumbnails-button').on('click', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          type: 'POST',
          url: route('settings.media.generate-thumbnails'),
          success: function success(res) {
            if (!res.error) {
              Botble.showSuccess(res.message);
            } else {
              Botble.showError(res.message);
            }
            _self.removeClass('button-loading');
            _self.closest('.modal').modal('hide');
          },
          error: function error(res) {
            Botble.handleError(res);
            _self.removeClass('button-loading');
            _self.closest('.modal').modal('hide');
          }
        });
      });
      if (typeof CodeMirror !== 'undefined') {
        Botble.initCodeEditor('mail-template-editor');
      }
      $(document).on('click', '.btn-trigger-reset-to-default', function (event) {
        event.preventDefault();
        $('#reset-template-to-default-button').data('target', $(event.currentTarget).data('target'));
        $('#reset-template-to-default-modal').modal('show');
      });
      $(document).on('click', '.js-select-mail-variable', function (event) {
        event.preventDefault();
        var $this = $(event.currentTarget);
        var doc = $('.CodeMirror')[0].CodeMirror;
        var key = '{{ ' + $this.data('key') + ' }}';

        // If there's a selection, replace the selection.
        if (doc.somethingSelected()) {
          doc.replaceSelection(key);
          return;
        }

        // Otherwise, we insert at the cursor position.
        var cursor = doc.getCursor();
        var pos = {
          line: cursor.line,
          ch: cursor.ch
        };
        doc.replaceRange(key, pos);
      });
      $(document).on('click', '.js-select-mail-function', function (event) {
        event.preventDefault();
        var $this = $(event.currentTarget);
        var CodeMirror = $('.CodeMirror')[0].CodeMirror;
        var key = $this.data('sample');

        // If there's a selection, replace the selection.
        if (CodeMirror.somethingSelected()) {
          CodeMirror.replaceSelection(key);
          return;
        }

        // Otherwise, we insert at the cursor position.
        var cursor = CodeMirror.getCursor();
        var position = {
          line: cursor.line,
          ch: cursor.ch
        };
        CodeMirror.replaceRange(key, position);
      });
      $(document).on('click', '#reset-template-to-default-button', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        _self.addClass('button-loading');
        $.ajax({
          type: 'POST',
          cache: false,
          url: _self.data('target'),
          data: {
            email_subject_key: $('input[name=email_subject_key]').val(),
            module: $('input[name=module]').val(),
            template_file: $('input[name=template_file]').val()
          },
          success: function success(res) {
            if (!res.error) {
              Botble.showSuccess(res.message);
              setTimeout(function () {
                window.location.reload();
              }, 1000);
            } else {
              Botble.showError(res.message);
            }
            _self.removeClass('button-loading');
            $('#reset-template-to-default-modal').modal('hide');
          },
          error: function error(res) {
            Botble.handleError(res);
            _self.removeClass('button-loading');
          }
        });
      });
      $(document).on('change', '.check-all', function (event) {
        var _self = $(event.currentTarget);
        var set = _self.attr('data-set');
        var checked = _self.prop('checked');
        $(set).each(function (index, el) {
          if (checked) {
            $(el).prop('checked', true);
          } else {
            $(el).prop('checked', false);
          }
        });
      });
      $('input.setting-selection-option').each(function (index, el) {
        var $settingContentContainer = $($(el).data('target'));
        $(el).on('change', function () {
          if ($(el).val() == '1') {
            $settingContentContainer.removeClass('d-none');
            Botble.initResources();
          } else {
            $settingContentContainer.addClass('d-none');
          }
        });
      });
      $(document).on('click', '.cronjob #copy-command', function () {
        _this.copyCommand();
      });
    }
  }, {
    key: "handleMultipleAdminEmails",
    value: function handleMultipleAdminEmails() {
      var $wrapper = $('#admin_email_wrapper');
      if (!$wrapper.length) {
        return;
      }
      var $addBtn = $wrapper.find('#add');
      var max = parseInt($wrapper.data('max'), 10);
      var emails = $wrapper.data('emails');
      if (emails.length === 0) {
        emails = [''];
      }
      var onAddEmail = function onAddEmail() {
        var count = $wrapper.find('input[type=email]').length;
        if (count >= max) {
          $addBtn.addClass('disabled');
        } else {
          $addBtn.removeClass('disabled');
        }
      };
      var addEmail = function addEmail() {
        var value = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
        return $addBtn.before("<div class=\"d-flex mt-2 more-email align-items-center\">\n                <input type=\"email\" class=\"next-input\" placeholder=\"".concat($addBtn.data('placeholder'), "\" name=\"admin_email[]\" value=\"").concat(value ? value : '', "\" />\n                <a class=\"btn btn-link text-danger\"><i class=\"fas fa-minus\"></i></a>\n            </div>"));
      };
      var render = function render() {
        emails.forEach(function (email) {
          addEmail(email);
        });
        onAddEmail();
      };
      $wrapper.on('click', '.more-email > a', function () {
        $(this).parent('.more-email').remove();
        onAddEmail();
      });
      $addBtn.on('click', function (e) {
        e.preventDefault();
        addEmail();
        onAddEmail();
      });
      render();
    }
  }, {
    key: "copyCommand",
    value: function () {
      var _copyCommand = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        var input, textToCopy, textarea;
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              input = $('.cronjob #command');
              textToCopy = input.val();
              if (!(navigator.clipboard && window.isSecureContext)) {
                _context.n = 2;
                break;
              }
              _context.n = 1;
              return navigator.clipboard.writeText(textToCopy);
            case 1:
              Botble.showSuccess(input.data('copied'));
              _context.n = 3;
              break;
            case 2:
              textarea = document.createElement('textarea');
              textarea.value = textToCopy;
              textarea.style.position = 'absolute';
              textarea.style.left = '-999999px';
              document.body.prepend(textarea);
              textarea.select();
              try {
                document.execCommand('copy');
                Botble.showSuccess(input.data('copied'));
              } catch (error) {
                console.error(error);
              } finally {
                textarea.remove();
              }
            case 3:
              return _context.a(2);
          }
        }, _callee);
      }));
      function copyCommand() {
        return _copyCommand.apply(this, arguments);
      }
      return copyCommand;
    }()
  }]);
}();
$(document).ready(function () {
  new SettingManagement().init();
});
/******/ })()
;