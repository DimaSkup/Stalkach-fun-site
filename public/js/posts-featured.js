/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/pages/posts-featured.js ***!
  \**********************************************/
document.addEventListener('DOMContentLoaded', function () {
  try {
    new Splide('.splide', {
      type: 'loop',
      autoplay: true,
      interval: 5000,
      gap: 40
    }).mount();
    videoPlayerScript();
  } catch (e) {
    console.error(e);
  }
});

function videoPlayerScript() {
  var videoSection = document.querySelector('[data-role="video-section"]');
  var videoId = videoSection.dataset.videoId;
  videoSection.style.backgroundImage = "url(\"https://img.youtube.com/vi/".concat(videoId, "/maxresdefault.jpg\")");
  var player = YouTubePlayer('video-player', {
    videoId: videoId
  }),
      body = document.querySelector('body'),
      videoWrap = document.querySelector('.video-wrap'),
      playCtrl = document.querySelector('[data-action="open-video"]'),
      closeCtrl = document.querySelector('[data-action="close-video"]');
  playCtrl.addEventListener('click', open);
  closeCtrl.addEventListener('click', close);

  function open() {
    body.classList.add('overflow-hidden');
    videoWrap.classList.remove('video-wrap--hide');
    videoWrap.classList.add('video-wrap--show');
    setTimeout(function () {
      return player.playVideo();
    }, 600);
  }

  function close() {
    player.stopVideo().then(function () {
      body.classList.remove('overflow-hidden');
      videoWrap.classList.remove('video-wrap--show');
      videoWrap.classList.add('video-wrap--hide');
    });
  }
}
/******/ })()
;