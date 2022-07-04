/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/pages/demo.dashboard.js":
/*!**********************************************!*\
  !*** ./resources/js/pages/demo.dashboard.js ***!
  \**********************************************/
/***/ (() => {

/**
 * Theme: Hyper - Responsive Bootstrap 5 Admin Dashboard
 * Author: Coderthemes
 * Module/App: Dashboard
 */
!function ($) {
  "use strict";

  var Dashboard = function Dashboard() {
    this.$body = $("body"), this.charts = [];
  };

  Dashboard.prototype.initCharts = function () {
    window.Apex = {
      chart: {
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      grid: {
        padding: {
          left: 0,
          right: 0
        }
      },
      colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
    };
    var colors = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
    var dataColors = $("#revenue-chart").data('colors');

    if (dataColors) {
      colors = dataColors.split(",");
    }

    var options = {
      chart: {
        height: 364,
        type: 'line',
        dropShadow: {
          enabled: true,
          opacity: 0.2,
          blur: 7,
          left: -7,
          top: 7
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 4
      },
      series: [{
        name: 'Current Week',
        data: [10, 20, 15, 25, 20, 30, 20]
      }, {
        name: 'Previous Week',
        data: [0, 15, 10, 30, 15, 35, 25]
      }],
      colors: colors,
      zoom: {
        enabled: false
      },
      legend: {
        show: false
      },
      xaxis: {
        type: 'string',
        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        tooltip: {
          enabled: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          formatter: function formatter(val) {
            return val + "k";
          },
          offsetX: -15
        }
      }
    };
    var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
    chart.render(); // --------------------------------------------------

    var colors = ["#727cf5", "#e3eaef"];
    var dataColors = $("#high-performing-product").data('colors');

    if (dataColors) {
      colors = dataColors.split(",");
    }

    var options = {
      chart: {
        height: 257,
        type: 'bar',
        stacked: true
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '20%'
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      series: [{
        name: 'Actual',
        data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81]
      }, {
        name: 'Projection',
        data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59]
      }],
      zoom: {
        enabled: false
      },
      legend: {
        show: false
      },
      colors: colors,
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          formatter: function formatter(val) {
            return val + "k";
          },
          offsetX: -15
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function formatter(val) {
            return "$" + val + "k";
          }
        }
      }
    };
    var chart = new ApexCharts(document.querySelector("#high-performing-product"), options);
    chart.render(); // --------------------------------------------------

    var colors = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
    var dataColors = $("#average-sales").data('colors');

    if (dataColors) {
      colors = dataColors.split(",");
    }

    var options = {
      chart: {
        height: 208,
        type: 'donut'
      },
      legend: {
        show: false
      },
      stroke: {
        colors: ['transparent']
      },
      series: [44, 55, 41, 17],
      labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
      colors: colors,
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }]
    };
    var chart = new ApexCharts(document.querySelector("#average-sales"), options);
    chart.render();
  }, // inits the map
  Dashboard.prototype.initMaps = function () {
    //various examples
    if ($('#world-map-markers').length > 0) {
      $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        regionStyle: {
          initial: {
            fill: '#e3eaef'
          }
        },
        markerStyle: {
          initial: {
            r: 9,
            'fill': '#727cf5',
            'fill-opacity': 0.9,
            'stroke': '#fff',
            'stroke-width': 7,
            'stroke-opacity': 0.4
          },
          hover: {
            'stroke': '#fff',
            'fill-opacity': 1,
            'stroke-width': 1.5
          }
        },
        backgroundColor: 'transparent',
        markers: [{
          latLng: [40.71, -74.00],
          name: 'New York'
        }, {
          latLng: [37.77, -122.41],
          name: 'San Francisco'
        }, {
          latLng: [-33.86, 151.20],
          name: 'Sydney'
        }, {
          latLng: [1.3, 103.8],
          name: 'Singapore'
        }],
        zoomOnScroll: false
      });
    }
  }, //initializing various components and plugins
  Dashboard.prototype.init = function () {
    var $this = this; // font
    // Chart.defaults.global.defaultFontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';        
    //default date range picker

    $('#dash-daterange').daterangepicker({
      singleDatePicker: true
    }); // init charts

    this.initCharts(); //init maps

    this.initMaps();
  }, //init flotchart
  $.Dashboard = new Dashboard(), $.Dashboard.Constructor = Dashboard;
}(window.jQuery), //initializing Dashboard
function ($) {
  "use strict";

  $(document).ready(function (e) {
    $.Dashboard.init();
  });
}(window.jQuery);

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/icons.scss":
/*!***********************************!*\
  !*** ./resources/scss/icons.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app-creative-dark.scss":
/*!***********************************************!*\
  !*** ./resources/scss/app-creative-dark.scss ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app-creative.scss":
/*!******************************************!*\
  !*** ./resources/scss/app-creative.scss ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app-dark.scss":
/*!**************************************!*\
  !*** ./resources/scss/app-dark.scss ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app-modern-dark.scss":
/*!*********************************************!*\
  !*** ./resources/scss/app-modern-dark.scss ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app-modern.scss":
/*!****************************************!*\
  !*** ./resources/scss/app-modern.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/pages/demo.dashboard": 0,
/******/ 			"assets/css/app-modern": 0,
/******/ 			"assets/css/app-modern-dark": 0,
/******/ 			"assets/css/app-dark": 0,
/******/ 			"assets/css/app-creative": 0,
/******/ 			"assets/css/app-creative-dark": 0,
/******/ 			"assets/css/icons": 0,
/******/ 			"assets/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/js/pages/demo.dashboard.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app-creative-dark.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app-creative.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app-dark.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app-modern-dark.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app-modern.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/app.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/app-modern","assets/css/app-modern-dark","assets/css/app-dark","assets/css/app-creative","assets/css/app-creative-dark","assets/css/icons","assets/css/app"], () => (__webpack_require__("./resources/scss/icons.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;