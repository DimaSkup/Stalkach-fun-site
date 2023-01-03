/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/pages/mod-page.js ***!
  \****************************************/
document.addEventListener('DOMContentLoaded', function () {
  var mainSlider = new Splide('.main-carousel', {
    type: 'fade',
    rewind: true,
    pagination: false,
    arrows: false
  });
  var thumbnailsSlider = new Splide('.thumbnail-carousel', {
    perPage: 3,
    fixedWidth: 100,
    gap: 10,
    rewind: true,
    pagination: false,
    isNavigation: true,
    focus: 'center'
  });
  mainSlider.sync(thumbnailsSlider);
  mainSlider.mount();
  thumbnailsSlider.mount();
  var modSectionSlider = new Splide('.mod-section', {
    type: 'fade',
    perPage: 1,
    pagination: false,
    arrows: false,
    drag: false,
    noDrag: 'input, textarea, .no-drag',
    breakpoints: {
      768: {
        drag: true
      }
    }
  });
  modSectionSlider.mount();
  var menuItems = document.querySelectorAll('#mod-navigation > a'); // Selecting corresponding section by anchor in URL

  modSectionSlider.go(slidePositionById(window.location.hash.substr(1))); // Switch to section when user clicked navigation element

  menuItems.forEach(function (item) {
    var match = item.getAttribute('href').match(/#([\w\-_]+)/im) || [];
    if (!match.hasOwnProperty(1)) return;
    var slidePosition = slidePositionById(match[1]);
    slidePosition !== null && item.addEventListener('click', function (e) {
      modSectionSlider.go(slidePosition);
    });
  }); // Setting active class in nav block when user switches slide

  modSectionSlider.on('active', function (e) {
    var activeNav = Array.from(menuItems).find(function (element) {
      return element.getAttribute('href') === '#' + e.slide.dataset.slideId;
    });
    setActiveNavItem(activeNav);
  });

  function slidePositionById(sliderId) {
    var slide = document.querySelector("[data-slide-id=\"".concat(sliderId, "\"]"));
    if (!slide) return;
    var slideMatch = slide.id.match(/splide[0-9]+-slide([0-9]+)/im) || [];
    return slideMatch.hasOwnProperty(1) ? parseInt(slideMatch[1]) - 1 : null;
  }

  function setActiveNavItem(item) {
    menuItems.forEach(function (navItem) {
      return navItem.classList.remove('active');
    });
    item && item.classList.add('active');
  }

  var openLightboxBtn = document.getElementById('open-lightbox');
  openLightboxBtn.addEventListener('click', function (e) {
    return fsLightboxInstances['gallery'].open();
  });
});
/******/ })()
;