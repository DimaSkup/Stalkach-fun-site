@extends('layouts.theme')

@section('js')
    <script src="{{ asset('js/mods-index.js') }}"></script>
@endsection

@section('content')
    <div class="mods">
        <section class="recently">
            <h2>Featured mods</h2>
            <div class="recent-mods">
                <div class="splide main-carousel">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="info-block">
                                    <h2>Anomaly</h2>
                                    <p>Sed et vehicula sem, ut convallis nulla. Quisque laoreet ultricies sem et condimentum. Curabitur vitae dolor vitae nisi ultrices dictum.</p>
                                    <div class="stat-wrapper">
                                        <div class="stat-block">
                                            <span><b>9.2</b>/10</span>
                                            <small>Rating</small>
                                        </div>
                                        <div class="stat-block">
                                            <span>32</span>
                                            <small>Subscribers</small>
                                        </div>
                                        <div class="stat-block">
                                            <span>800</span>
                                            <small>Views</small>
                                        </div>
                                    </div>
                                </div>
                                <video autoplay loop muted poster="{{ asset('img/333.jpeg') }}" id="background" class="bg-illustration">
                                    <source src="{{ asset('video/333.mp4') }}" type="video/mp4">
                                </video>
                            </li>
                            @foreach(array_fill(1, 5, 1) as $key => $item)
                                <li class="splide__slide">
                                    <img class="bg-illustration" src="https://picsum.photos/1240/600?random={{ $key }}" alt="">
                                    <div class="info-block">
                                        <h2>Lost in the dark</h2>
                                        <p>Vestibulum fringilla molestie sollicitudin. Sed et vehicula sem, ut convallis nulla. Quisque laoreet ultricies sem et condimentum. Curabitur vitae dolor vitae nisi ultrices dictum.</p>
                                        <div class="stat-wrapper">
                                            <div class="stat-block">
                                                <span><b>9.2</b>/10</span>
                                                <small>Rating</small>
                                            </div>
                                            <div class="stat-block">
                                                <span>32</span>
                                                <small>Subscribers</small>
                                            </div>
                                            <div class="stat-block">
                                                <span>800</span>
                                                <small>Views</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="recent-mods-content">
                    <div class="splide thumbnail-carousel">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <img src="{{ asset('img/333.jpeg') }}" alt="">
                                </li>
                                @foreach(array_fill(5, 5, 1) as $key => $item)
                                    <li class="splide__slide">
                                        <img src="https://picsum.photos/700/900?random={{ $key }}" alt="">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection