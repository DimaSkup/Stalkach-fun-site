{{--
    (MAIN MODS PAGE)
    a section with the list with top 10 mods today (second carousel);
    contains the navigation arrows and a list with mods
--}}

@php
    $today = date("F j")  /* Month name + day number */
@endphp

<section class="top-mods">
    <h2>Top 10 in {{ $today }}</h2>

    {{-- TOP 10 MODS CAROUSEL --}}
    <div class="splide top-mods-carousel">

        {{-- carousel arrows --}}
        <div class="splide__arrows">
            <button class="splide__arrow splide__arrow--prev">
                <span class="material-icons">west</span>
            </button>
            <button class="splide__arrow splide__arrow--next">
                <span class="material-icons">east</span>
            </button>
        </div>

        {{-- a list with top 10 mods --}}
        <div class="splide__track">
            <ul class="splide__list">
                @include ('mods.includes._index_top_10_mods_today_list')
            </ul>
        </div>
    </div>
</section>