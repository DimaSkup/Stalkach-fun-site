/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/global/progressbar.js":
/*!********************************************!*\
  !*** ./resources/js/global/progressbar.js ***!
  \********************************************/
/***/ (() => {

var progressBar = document.getElementById("progress-bar");

if (progressBar) {
  document.addEventListener('scroll', function () {
    var docElem = document.documentElement,
        docBody = document.body,
        scrollTop = docElem['scrollTop'] || docBody['scrollTop'],
        scrollBottom = (docElem['scrollHeight'] || docBody['scrollHeight']) - window.innerHeight,
        scrollPercent = scrollTop / scrollBottom * 100 + '%';
    progressBar.style.setProperty("--scrollAmount", scrollPercent);
  });
}

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
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!************************************!*\
  !*** ./resources/js/pages/post.js ***!
  \************************************/
document.addEventListener('DOMContentLoaded', function () {
  __webpack_require__(/*! ../global/progressbar */ "./resources/js/global/progressbar.js");
});
})();

/******/ })()
;