<section class="splide featured-carousel" aria-label="Featured carousel">
    <ul class="splide__pagination splide__pagination--ltr" role="tablist" aria-label="Select a slide to show"></ul>

    <div style="position: relative">
        <div class="splide__arrows splide__arrows--ltr">
            <button
                    class="splide__arrow splide__arrow--prev"
                    type="button"
                    aria-label="Previous slide"
                    aria-controls="splide01-track"
            >
                <span class="material-icons">navigate_before</span>
            </button>
            <button
                    class="splide__arrow splide__arrow--next"
                    type="button"
                    aria-label="Next slide"
                    aria-controls="splide01-track"
            >
                <span class="material-icons">navigate_next</span>
            </button>
        </div>

        <div class="splide__track">
            <ul class="splide__list">
                @foreach($featuredPosts as $post)
                    <li class="splide__slide hero-slide hero-slide--type1"
                        @if($loop->index % 3 === 0)
                            style="background-image: url('https://www.stalker2.com/_nuxt/img/assets/pages/main/s5-requirements/bg.jpg')"
                        @elseif($loop->index % 2 == 0)
                            style="background-image: url('https://www.stalker2.com/_nuxt/img/assets/pages/main/s6-game-hunting/bg.webp')"
                        @else
                            style="background-image: url(https://www.stalker2.com/_nuxt/img/assets/pages/main/s2-about/bg.webp)"
                        @endif
                    >
                        <article class="article hero-post">
                            <a class="thumb-img" href="{{ $post->url }}">
                                @include('posts._overlays')
                                <img src="{{ $post->main_image_album }}">
                            </a>
                            <div class="text">
                                <a href="{{ $post->url }}">
                                    <h3>{{ $post->title }}</h3>
                                </a>
                                <p>{{ $post->desctiption }}</p>
                                <div class="subtitle">
                                    <time datetime="2020-05-25 12:00:00">{{ $post->created_time }} ▶
                                    <a href="{{ $post->author->get('url') }}">{{ $post->author->get('title') }}</a></time>
                                </div>
                            </div>
                        </article>
                        <b>{{ $post->category->name }}</b>
                        <img class="hero-image" src="
                        @if($loop->index % 3 === 0)
                            {{ asset('img/ree.png') }}
                        @elseif($loop->index % 2 === 0)
                            {{ asset('img/33.png') }}
                        @else
                            {{ asset('img/22.png') }}
                        @endif" alt="hero image">
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="splide__progress">
{{--            <div class="splide__progress__bar" style="height: 3px; background: #ccc;"></div>--}}
        </div>
    </div>
</section>