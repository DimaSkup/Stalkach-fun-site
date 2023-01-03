@extends('layouts.theme')

@section('js')
    <script src="{{ mix('js/post-gallery.js') }}"></script>
@endsection

@section('content')
    <section id="post-gallery">
        @include('posts.show._navigation')
        <div class="gallery-wrapper content-container">
            <div id="gallery-carousel" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($post->gallery_images as $image)
                            <li class="splide__slide">
                                <a data-fslightbox="gallery" href="{{ $image }}">
                                    <img src="{{ $image }}" alt="" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="thumbnail-carousel" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($post->gallery_images as $image)
                            <li class="splide__slide">
                                <img src="{{ $image }}" alt="" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="post-body">
            <div class="post-info">
                @include('posts.show._header-min')
                <div class="post-content">
                    {!! $post->text !!}
                </div>
            </div>

            @include('posts.show._feedback-buttons')

            <div class="post-sidebar">
                @include('posts.show._tags', ['post' => $post])
            </div>
        </div>
    </section>
    @include('posts.show._recommendations', ['posts' => $relatedPosts])
    @include('sections.newsletter')
@endsection