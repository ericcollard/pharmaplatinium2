/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/pages/demo.form-wizard.js ***!
  \************************************************/
/**
 * Theme: Hyper - Responsive Bootstrap 5 Admin Dashboard
 * Author: Coderthemes
 * Module/App: Form Wizard
 */
$(function () {
  "use strict";

  $('#basicwizard').bootstrapWizard();
  $('#progressbarwizard').bootstrapWizard({
    onTabShow: function onTabShow(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index + 1;
      var $percent = $current / $total * 100;
      $('#progressbarwizard').find('.bar').css({
        width: $percent + '%'
      });
    }
  });
  $('#btnwizard').bootstrapWizard({
    'nextSelector': '.button-next',
    'previousSelector': '.button-previous',
    'firstSelector': '.button-first',
    'lastSelector': '.button-last'
  });
  $('#rootwizard').bootstrapWizard({
    'onNext': function onNext(tab, navigation, index) {
      var form = $($(tab).data("targetForm"));

      if (form) {
        form.addClass('was-validated');

        if (form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          return false;
        }
      }
    }
  });
});
/******/ })()
;