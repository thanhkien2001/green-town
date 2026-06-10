/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************************!*\
  !*** ./platform/core/dashboard/resources/assets/js/dashboard.js ***!
  \******************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
// import VerifyLicenseComponent from './components/VerifyLicenseComponent.vue'
// import CheckUpdateComponent from './components/CheckUpdateComponent.vue'

if (typeof vueApp !== 'undefined') {
  vueApp.booting(function (vue) {
    // vue.component('verify-license-component', VerifyLicenseComponent)
    // vue.component('check-update-component', CheckUpdateComponent)
  });
}
var callbackWidgets = {};
var BDashboard = /*#__PURE__*/function () {
  function BDashboard() {
    _classCallCheck(this, BDashboard);
  }
  return _createClass(BDashboard, [{
    key: "init",
    value: function init() {
      var list_widgets = $('#list_widgets');
      $(document).on('click', '.portlet > .portlet-title .tools > a.remove', function (event) {
        event.preventDefault();
        $('#hide-widget-confirm-bttn').data('id', $(event.currentTarget).closest('.widget_item').prop('id'));
        $('#hide_widget_modal').modal('show');
      });
      list_widgets.on('click', '.page_next, .page_previous', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        var href = $this.prop('href');
        if (href) {
          BDashboard.loadWidget($this.closest('.portlet').find('.portlet-body'), href);
        }
      });
      list_widgets.on('change', '.number_record .numb', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        var numb = $this.closest('.number_record').find('.numb');
        var paginate = numb.val();
        if (!isNaN(paginate) && paginate > 0) {
          BDashboard.loadWidget($this.closest('.portlet').find('.portlet-body'), $this.closest('.widget_item').attr('data-url'), {
            paginate: paginate
          });
        } else {
          Botble.showError('Please input a number!');
        }
      });
      list_widgets.on('click', '.btn_change_paginate', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        var numb = $this.closest('.number_record').find('.numb');
        var min = parseInt(numb.prop('min') || 5);
        var max = parseInt(numb.prop('max') || 100);
        var step = parseInt(numb.prop('step') || 5);
        var paginate = parseInt(numb.val());
        if ($this.hasClass('btn_up')) {
          if (paginate < max) {
            paginate += step;
          }
        } else if ($this.hasClass('btn_down')) {
          if (paginate - step > 0) {
            paginate -= step;
          } else {
            paginate = step;
          }
          if (paginate < min) {
            paginate = min;
          }
        }
        if (paginate != parseInt(numb.val())) {
          numb.val(paginate).trigger('change');
        }
      });
      $('#hide-widget-confirm-bttn').on('click', function (event) {
        event.preventDefault();
        var name = $(event.currentTarget).data('id');
        $.ajax({
          type: 'GET',
          cache: false,
          url: route('dashboard.hide_widget', {
            name: name
          }),
          success: function success(res) {
            if (!res.error) {
              $('#' + name).fadeOut();
              Botble.showSuccess(res.message);
            } else {
              Botble.showError(res.message);
            }
            $('#hide_widget_modal').modal('hide');
            var portlet = $(event.currentTarget).closest('.portlet');
            if ($(document).hasClass('page-portlet-fullscreen')) {
              $(document).removeClass('page-portlet-fullscreen');
            }
            portlet.find('[data-bs-toggle=tooltip]').tooltip('destroy');
            portlet.remove();
          },
          error: function error(data) {
            Botble.handleError(data);
          }
        });
      });
      $(document).on('click', '.portlet:not(.widget-load-has-callback) > .portlet-title .tools > a.reload', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        BDashboard.loadWidget($this.closest('.portlet').find('.portlet-body'), $this.closest('.widget_item').attr('data-url'));
      });
      $(document).on('click', '.portlet > .portlet-title .tools > .collapse, .portlet .portlet-title .tools > .expand', function (event) {
        event.preventDefault();
        var _self = $(event.currentTarget);
        var $portlet = _self.closest('.portlet');
        var state = $.trim(_self.data('state'));
        if (state === 'expand') {
          $portlet.find('.portlet-body').removeClass('collapse').addClass('expand');
          BDashboard.loadWidget($portlet.find('.portlet-body'), _self.closest('.widget_item').attr('data-url'));
        } else {
          $portlet.find('.portlet-body').removeClass('expand').addClass('collapse');
        }
        $.ajax({
          type: 'POST',
          cache: false,
          url: route('dashboard.edit_widget_setting_item'),
          data: {
            name: _self.closest('.widget_item').prop('id'),
            setting_name: 'state',
            setting_value: state
          },
          success: function success() {
            if (state === 'collapse') {
              _self.data('state', 'expand');
              $portlet.find('.predefined-ranges').addClass('d-none');
              $portlet.find('a.reload').addClass('d-none');
              $portlet.find('a.fullscreen').addClass('d-none');
            } else {
              _self.data('state', 'collapse');
              $portlet.find('.predefined-ranges').removeClass('d-none');
              $portlet.find('a.reload').removeClass('d-none');
              $portlet.find('a.fullscreen').removeClass('d-none');
            }
          },
          error: function error(data) {
            Botble.handleError(data);
          }
        });
      });
      $(document).on('change', '.portlet select[name=predefined_range]', function (e) {
        e.preventDefault();
        var $this = $(e.currentTarget);
        BDashboard.loadWidget($this.closest('.portlet').find('.portlet-body'), $this.closest('.widget_item').attr('data-url'), {
          changed_predefined_range: 1
        });
      });
      var $manageWidgetModal = $('#manage_widget_modal');
      $(document).on('click', '.manage-widget', function (event) {
        event.preventDefault();
        $manageWidgetModal.modal('show');
      });
      $manageWidgetModal.on('change', '.swc_wrap input', function (event) {
        $(event.currentTarget).closest('section').find('i').toggleClass('widget_none_color');
      });
    }
  }], [{
    key: "loadWidget",
    value: function loadWidget(el, url, data, callback) {
      var widgetItem = el.closest('.widget_item');
      var widgetId = widgetItem.attr('id');
      if (typeof callback !== 'undefined') {
        callbackWidgets[widgetId] = callback;
      }
      var $collapseExpand = widgetItem.find('a.collapse-expand');
      if ($collapseExpand.length && $collapseExpand.hasClass('collapse')) {
        return;
      }
      Botble.blockUI({
        target: el,
        iconOnly: true,
        overlayColor: 'none'
      });
      if (typeof data === 'undefined' || data == null) {
        data = {};
      }
      var predefinedRange = widgetItem.find('select[name=predefined_range]');
      if (predefinedRange.length) {
        data.predefined_range = predefinedRange.val();
      }
      $.ajax({
        type: 'GET',
        cache: false,
        url: url,
        data: data,
        success: function success(res) {
          Botble.unblockUI(el);
          if (!res.error) {
            el.html(res.data);
            if (typeof callback !== 'undefined') {
              callback();
            } else if (callbackWidgets[widgetId]) {
              callbackWidgets[widgetId]();
            }
            if (el.find('.scroller').length !== 0) {
              Botble.callScroll(el.find('.scroller'));
            }
            $('.equal-height').equalHeights();
            BDashboard.initSortable();
          } else {
            el.html('<div class="dashboard_widget_msg col-12"><p>' + res.message + '</p>');
          }
        },
        error: function error(res) {
          Botble.unblockUI(el);
          Botble.handleError(res);
        }
      });
    }
  }, {
    key: "initSortable",
    value: function initSortable() {
      if ($('#list_widgets').length > 0) {
        var el = document.getElementById('list_widgets');
        Sortable.create(el, {
          group: 'widgets',
          // or { name: "...", pull: [true, false, clone], put: [true, false, array] }
          sort: true,
          // sorting inside list
          delay: 0,
          // time in milliseconds to define when the sorting should start
          disabled: false,
          // Disables the sortable if set to true.
          store: null,
          // @see Store
          animation: 150,
          // ms, animation speed moving items when sorting, `0` — without animation
          handle: '.portlet-title',
          ghostClass: 'sortable-ghost',
          // Class name for the drop placeholder
          chosenClass: 'sortable-chosen',
          // Class name for the chosen item
          dataIdAttr: 'data-id',
          forceFallback: false,
          // ignore the HTML5 DnD behaviour and force the fallback to kick in
          fallbackClass: 'sortable-fallback',
          // Class name for the cloned DOM Element when using forceFallback
          fallbackOnBody: false,
          // Appends the cloned DOM Element into the Document's Body

          scroll: true,
          // or HTMLElement
          scrollSensitivity: 30,
          // px, how near the mouse must be to an edge to start scrolling.
          scrollSpeed: 10,
          // px

          // Changed sorting within list
          onUpdate: function onUpdate() {
            var items = [];
            $.each($('.widget_item'), function (index, widget) {
              items.push($(widget).prop('id'));
            });
            $.ajax({
              type: 'POST',
              cache: false,
              url: route('dashboard.update_widget_order'),
              data: {
                items: items
              },
              success: function success(res) {
                if (!res.error) {
                  Botble.showSuccess(res.message);
                } else {
                  Botble.showError(res.message);
                }
              },
              error: function error(data) {
                Botble.handleError(data);
              }
            });
          }
        });
      }
    }
  }]);
}();
$(document).ready(function () {
  new BDashboard().init();
  window.BDashboard = BDashboard;
});
/******/ })()
;