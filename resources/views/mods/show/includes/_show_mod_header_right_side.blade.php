{{--
    A SINGLE MODIFICATION PAGE
    (header)

    the current mod stats; a carousel for changing of the background images
--}}

<div class="right-side">
    <div class="stat-wrapper">
        <div class="stat-block">
            <span><b> {{ $mod->averageGrade }}</b>/10</span>
            <small>Rating</small>
        </div>
        <div class="stat-block">
            <span>{{ $mod->subscribersCount }}</span>
            <small>Subscribers</small>
        </div>
        <div class="stat-block">
            <span>{{ $mod->views }}</span>
            <small>Views</small>
        </div>
    </div>

    {{-- a carousel with the gallery video / screenshots --}}
    <div class="splide thumbnail-carousel">
        <div class="splide__track">
            <ul class="splide__list">
                @if ($mod->galleryVideo)
                    <li class="splide__slide">
                        <img src="{{ asset('img/333.jpeg') }}" alt="">
                    </li>
                @endif
                @foreach($mod->screenshots as $key => $screenImagePath)
                    <li class="splide__slide">
                        <img src="{{ $screenImagePath }}" alt="single_mod_screenshot_image">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>