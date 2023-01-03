document.addEventListener('DOMContentLoaded', function () {
    try {
        new Splide( '.splide', {
            type: 'loop',
            autoplay: true,
            interval: 5000,
            gap: 40
        }).mount();

        videoPlayerScript();
    } catch (e) {
        console.error(e);
    }
})


function videoPlayerScript() {
    const videoSection = document.querySelector('[data-role="video-section"]')
    const videoId = videoSection.dataset.videoId;

    videoSection.style.backgroundImage = `url("https://img.youtube.com/vi/${videoId}/maxresdefault.jpg")`;
    let player = YouTubePlayer('video-player', {
            videoId,
        }),
        body = document.querySelector('body'),
        videoWrap = document.querySelector('.video-wrap'),
        playCtrl = document.querySelector('[data-action="open-video"]'),
        closeCtrl = document.querySelector('[data-action="close-video"]');

    playCtrl.addEventListener('click', open);
    closeCtrl.addEventListener('click', close);

    function open() {
        body.classList.add('overflow-hidden');
        videoWrap.classList.remove('video-wrap--hide')
        videoWrap.classList.add('video-wrap--show')
        setTimeout(() => player.playVideo(), 600);
    }

    function close() {
        player.stopVideo()
            .then(() => {
                body.classList.remove('overflow-hidden');
                videoWrap.classList.remove('video-wrap--show');
                videoWrap.classList.add('video-wrap--hide');
            });
    }
}