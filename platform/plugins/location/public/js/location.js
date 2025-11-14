/******/ (() => { // webpackBootstrap
/*!*******************************************************************!*\
  !*** ./platform/plugins/location/resources/assets/js/location.js ***!
  \*******************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var Location = /*#__PURE__*/function () {
  function Location() {
    _classCallCheck(this, Location);
  }
  return _createClass(Location, null, [{
    key: "changeProvince",
    value: function changeProvince($element) {
      var $city = $(document).find('select[data-type=city]');
      if ($element.data('related-city')) {
        $city = $(document).find('#' + $element.data('related-city'));
      }
      var url = $element.data('change-state-url');
      if (url !== null && url !== '' && $element.val() !== '') {
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            'state_id': $element.val()
          },
          beforeSend: function beforeSend() {
            $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', true);
          },
          success: function success(data) {
            var option = '<option value="">' + $city.data('placeholder') + '</option>';
            $.each(data.data, function (index, item) {
              if (item.id === $city.data('origin-value')) {
                option += '<option value="' + item.id + '" selected="selected">' + item.name + '</option>';
              } else {
                option += '<option value="' + item.id + '">' + item.name + '</option>';
              }
            });
            $city.html(option);
            $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', false);
          }
        });
      }
    }
  }]);
}();
$(document).ready(function () {
  var $state_fields = $(document).find('select[data-type=state]');
  if ($state_fields.length > 0) {
    $.each($state_fields, function (index, el) {
      Location.changeProvince($(el));
    });
    $(document).on('change', 'select[data-type=state]', function (event) {
      Location.changeProvince($(event.currentTarget));
    });
  }
});
/******/ })()
;