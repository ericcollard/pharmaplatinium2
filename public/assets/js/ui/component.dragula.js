/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/ui/component.dragula.js ***!
  \**********************************************/
/**
* Theme: Hyper - Responsive Bootstrap 5 Admin Dashboard
* Author: Coderthemes
* Component: Dragula component
*/
!function ($) {
  "use strict";

  var Dragula = function Dragula() {
    this.$body = $("body");
  };
  /* Initializing */


  Dragula.prototype.init = function () {
    $('[data-plugin="dragula"]').each(function () {
      var containersIds = $(this).data("containers");
      var containers = [];

      if (containersIds) {
        for (var i = 0; i < containersIds.length; i++) {
          containers.push($("#" + containersIds[i])[0]);
        }
      } else {
        containers = [$(this)[0]];
      } // if handle provided


      var handleClass = $(this).data("handleclass"); // init dragula

      if (handleClass) {
        dragula(containers, {
          moves: function moves(el, container, handle) {
            return handle.classList.contains(handleClass);
          }
        });
      } else {
        dragula(containers);
      }
    });
  }, //init dragula
  $.Dragula = new Dragula(), $.Dragula.Constructor = Dragula;
}(window.jQuery), //initializing Dragula
function ($) {
  "use strict";

  $.Dragula.init();
}(window.jQuery);
/******/ })()
;