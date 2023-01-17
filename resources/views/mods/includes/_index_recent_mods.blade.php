{{--
    (MAIN MODS PAGE)
    a section with the list of recent mods
    (the first carousel with mods + some info about each mod)
--}}

@php
    $legacyMode = false
@endphp

<section class="featured-mods">

    {{-- A MAIN IMAGE/GALLERY VIDEO OF CURRENT MODIFICATION WHICH WAS CHOSEN IN THE CAROUSEL --}}
    <div class="splide bg-carousel">
        <div class="splide__track">
            <ul class="splide__list">
               {{--
                <li class="splide__slide">
                    <video autoplay loop muted poster="{{ asset('img/333.jpeg') }}" id="background" class="bg-illustration">
                        <source src="{{ asset('video/333.mp4') }}" type="video/mp4">
                    </video>
                </li>
               --}}
                @foreach ($latestMods as $key => $mod)
                    <li class="splide__slide">
                        <img src="{{ $mod->mainImage }}" alt="mod_main_image">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="section-content">
        <div class="header">
            <div class="alt-header">
                <span class="material-icons">schedule</span>
                <span class="header-text">Recent mods</span>
                <span class="decoration-line"></span>
            </div>
        </div>


        {{-- SOME INFO ABOUT A RECENT MODIFICATION --}}
        <div class="info-wrapper">
            <div class="splide info-carousel">
                <div class="splide__track">
                    <ul class="splide__list">

                        @if ($legacyMode)
                            @include ('mods.includes.legacy._index_recent_mods_mod_info')
                        @else
                            @include ('mods.includes._index_recent_mods_mod_info')
                        @endif

                    </ul>
                </div>
            </div>

            {{-- A CAROUSEL WITH THE LIST OF RECENT MODS --}}
            <div class="thumbnail-carousel-wrapper">
                <div class="splide thumbnail-carousel">
                    <div class="splide__track">
                        <ul class="splide__list">

                            @foreach ($latestMods as $key => $mod)
                                <li class="splide__slide">
                                    <img src="{{ $mod->boxartImage }}" alt="mod_boxart_image">
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>