/******/ (() => { // webpackBootstrap
/*!*************************************************************************!*\
  !*** ./platform/plugins/real-estate/resources/assets/js/real-estate.js ***!
  \*************************************************************************/
$(document).ready(function () {
  $(document).on('change', '#type_id', function (event) {
    console.log($(event.currentTarget).val());
    if ($(event.currentTarget).val() == 2) {
      $('#period').closest('.period-form-group').removeClass('hidden').fadeIn();
    } else {
      $('#period').closest('.period-form-group').addClass('hidden').fadeOut();
    }
  });
  $(document).on('change', '#never_expired', function (event) {
    if ($(event.currentTarget).is(':checked') === true) {
      $('#auto_renew').closest('.auto-renew-form-group').addClass('hidden').fadeOut();
    } else {
      $('#auto_renew').closest('.auto-renew-form-group').removeClass('hidden').fadeIn();
    }
  });
});
/******/ })()
;