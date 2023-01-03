const preloader = document.getElementById('preloader');

if(preloader) {
    preloader.style.opacity = '0';
    preloader.addEventListener('transitionend', () => preloader.remove());
}