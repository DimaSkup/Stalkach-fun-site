document.addEventListener('DOMContentLoaded', function () {
    const mainSlider = new Splide('#gallery-carousel', {
        type      : 'fade',
        rewind    : true,
        pagination: false,
        arrows    : false,
    });

    const thumbnailsSlider = new Splide('#thumbnail-carousel', {
        perPage: 5,
        gap: 10,
        rewind: true,
        pagination: false,
        isNavigation: true,
        focus: 'center',
    });

    mainSlider.sync(thumbnailsSlider);
    mainSlider.mount();
    thumbnailsSlider.mount();
});