{{--
    A SINGLE MODIFICATION PAGE
    (header)

    background images which are shown according to the carousel
--}}

<div class="splide main-carousel">
    <div class="splide__track">
        <ul class="splide__list">

            {{-- if we have a gallery video for this modification we'll show it --}}
            @if ($mod->galleryVideo)
                <li class="splide__slide">
                    <a data-fslightbox="gallery" href="{{ asset('video/333.mp4') }}">
                        <video autoplay loop muted poster="{{ asset('img/333.jpeg') }}" id="background">
                            <source src="{{ asset('video/333.mp4') }}" type="video/mp4">
                        </video>
                    </a>
                </li>
            @endif

            {{-- mod's main image --}}
            <li class="splide__slide">
                <a data-fslightbox="gallery" href="{{ $mod->mainImage }}">
                    <img src="{{ $mod->mainImage }}" alt="single_mod_main_image">
                </a>
            </li>

            {{-- mod screenshots for background --}}
            @foreach($mod->screenshots as $key => $screenImagePath)
                <li class="splide__slide">
                    <a data-fslightbox="gallery" href="{{ $screenImagePath }}">
                        <img src="{{ $screenImagePath }}" alt="single_mod_screenshot_image">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>