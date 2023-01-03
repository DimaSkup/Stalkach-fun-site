/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/pages/post-gallery.js ***!
  \********************************************/
document.addEventListener('DOMContentLoaded', function () {
  var mainSlider = new Splide('#gallery-carousel', {
    type: 'fade',
    rewind: true,
    pagination: false,
    arrows: false
  });
  var thumbnailsSlider = new Splide('#thumbnail-carousel', {
    perPage: 5,
    gap: 10,
    rewind: true,
    pagination: false,
    isNavigation: true,
    focus: 'center'
  });
  mainSlider.sync(thumbnailsSlider);
  mainSlider.mount();
  thumbnailsSlider.mount();
});
/******/ })()
;