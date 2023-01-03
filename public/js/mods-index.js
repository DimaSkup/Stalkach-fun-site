/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/pages/mods-index.js ***!
  \******************************************/
document.addEventListener('DOMContentLoaded', function () {
  var bgSlider = new Splide('.bg-carousel', {
    type: 'slider',
    rewind: true,
    pagination: false,
    arrows: false
  });
  var infoSlider = new Splide('.info-carousel', {
    type: 'fade',
    rewind: true,
    pagination: false,
    arrows: false
  });
  var thumbnailsSlider = new Splide('.thumbnail-carousel', {
    perPage: 4,
    perMove: 1,
    gap: 10,
    rewind: true,
    pagination: false,
    isNavigation: true,
    padding: {
      right: 40
    },
    breakpoints: {
      1200: {
        perPage: 3
      },
      992: {
        perPage: 2
      },
      768: {
        perPage: 1
      }
    }
  });
  bgSlider.sync(thumbnailsSlider);
  bgSlider.mount();
  infoSlider.sync(thumbnailsSlider);
  infoSlider.mount();
  thumbnailsSlider.mount();
  var topModsSlider = new Splide('.top-mods-carousel', {
    type: 'loop',
    perPage: 6,
    perMove: 1,
    gap: 10,
    pagination: false,
    breakpoints: {
      992: {
        perPage: 5
      },
      768: {
        perPage: 4
      },
      576: {
        perPage: 3
      }
    }
  });
  topModsSlider.mount();
  var form = document.querySelector('[name="browse-mods"]');
  var formLoader = form.querySelector('.s-mini-loader');
  form.addEventListener('submit', function (e) {
    e.preventDefault();
  });
  form.addEventListener('change', function () {
    formLoader.classList.add('loading');
    setTimeout(function () {
      return formLoader.classList.remove('loading');
    }, 1500);
  });
});
/******/ })()
;