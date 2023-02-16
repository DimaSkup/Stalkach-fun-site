document.addEventListener('DOMContentLoaded', function () {
    const mainSlider = new Splide('.main-carousel', {
        type      : 'fade',
        rewind    : true,
        pagination: false,
        arrows    : false,
    });


    const thumbnailsSlider = new Splide('.thumbnail-carousel', {
        perPage: 3,
        fixedWidth: 100,
        gap: 10,
        rewind: true,
        pagination: false,
        isNavigation: true,
        focus: 'center',
    });

    mainSlider.sync(thumbnailsSlider);
    mainSlider.mount();
    thumbnailsSlider.mount();

    const modSectionSlider = new Splide('.mod-section', {
        type: 'fade',
        perPage: 1,
        pagination: false,
        arrows: false,
        drag: false,
        noDrag: 'input, textarea, .no-drag',
        breakpoints: {
            768: {
                drag: true,
            },
        }
    });
    modSectionSlider.mount();
    const menuItems = document.querySelectorAll('#mod-navigation > a');

    // Selecting corresponding section by anchor in URL
    modSectionSlider.go(slidePositionById(window.location.hash.substr(1)));

    // Switch to section when user clicked navigation element
    menuItems.forEach(item => {
        const match = item.getAttribute('href').match(/#([\w\-_]+)/im) || [];
        if(!match.hasOwnProperty(1)) return;

        const slidePosition = slidePositionById(match[1]);
        slidePosition !== null && item.addEventListener('click', e => {
            modSectionSlider.go(slidePosition);
        });
    })

    // Setting active class in nav block when user switches slide
    modSectionSlider.on('active', (e) => {
        const activeNav = Array.from(menuItems)
            .find(element => element.getAttribute('href') === '#' + e.slide.dataset.slideId);
        setActiveNavItem(activeNav);
    });

    function slidePositionById(sliderId) {
        const slide = document.querySelector(`[data-slide-id="${sliderId}"]`);
        if(!slide) return;

        const slideMatch = slide.id.match(/splide[0-9]+-slide([0-9]+)/im) || [];
        return slideMatch.hasOwnProperty(1)
            ? parseInt(slideMatch[1]) - 1
            : null;
    }

    function setActiveNavItem(item) {
        menuItems.forEach(navItem => navItem.classList.remove('active'));
        item && item.classList.add('active');
    }

    const openLightboxBtn = document.getElementById('open-lightbox');
    openLightboxBtn.addEventListener(
        'click',
        e => fsLightboxInstances['gallery'].open()
    );
});