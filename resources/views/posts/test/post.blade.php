@extends('layouts.theme')

@section('content')
    {{--	<!-- Page top section -->--}}
    {{--	<section class="page-top-section set-bg" data-setbg="img/page-top-bg/1.jpg">--}}
    {{--		<div class="page-info">--}}
    {{--			<h2>Games</h2>--}}
    {{--			<div class="site-breadcrumb">--}}
    {{--				<a href="">Home</a>  /--}}
    {{--				<span>Games</span>--}}
    {{--			</div>--}}
    {{--		</div>--}}
    {{--	</section>--}}
    {{--	<!-- Page top end-->--}}


    <!-- Games section -->
    <section class="games-single-page">
        <div class="container">
            <div class="game-single-preview">
                {{-- if there is a video, show iframe with source to this video--}}
                @if ($post->type === 'video')
                    <iframe src="//www.youtube.com/embed/{{$post->videoId}}" frameborder="0" allowfullscreen width="560" height="315"></iframe>
                @else
                {{-- we have not a video post, show a usual image --}}
                    <img src="{{ asset($post->mainImage) }}" alt="post_image">
                @endif
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5 sidebar game-page-sideber">
                    <div class="widget-sticky-container ">
                        <div class="widget-item">
                            <div class="rating-widget">
                                <h4 class="widget-title">Ratings</h4>
                                <ul>
                                    <li>Price<span>3.5/5</span></li>
                                    <li>Graphics<span>4.5/5</span></li>
                                    <li>Levels<span>3.5/5</span></li>
                                    <li>Levels<span>4.5/5</span></li>
                                    <li>Dificulty<span>4.5/5</span></li>
                                </ul>
                                <div class="rating">
                                    <h5><i>Rating</i><span>4.5</span> / 5</h5>
                                </div>
                            </div>
                        </div>
                        <div class="widget-item">
                            <div class="testimonials-widget">
                                <h4 class="widget-title">Testimonials</h4>
                                <div class="testim-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolo re magna aliqua. Quis ipsum suspend isse ultrices.</p>
                                    <h6><span>James Smith,</span>Gamer</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 game-single-content">
                    <div class="gs-meta">{{ $post->created_at }}  /  in <a href="">
                            @foreach ($post->tags as $tag)
                                <a href="{{ $tag->routeSearchByTag }}">{{ $tag->name }}</a>
                            @endforeach
                        </a>
                    </div>
                    <h2 class="gs-title">{{ $post->title }}</h2>
                    <h4>Gameplay</h4>
                    <p>
                        {{ $post->text }}
                    </p>
                    <h4>Conclusion</h4>
                    <p>
                        {{ $post->text }}
                    </p>
                    <div class="geme-social-share pt-5 d-flex">
                        <p>Share:</p>
                        <a href="#"><i class="fa fa-pinterest">pinterest</i></a>
                        <a href="#"><i class="fa fa-facebook"></i>facebook</a>
                        <a href="#"><i class="fa fa-twitter"></i>twitter</a>
                        <a href="#"><i class="fa fa-dribbble"></i>dribble</a>
                        <a href="#"><i class="fa fa-behance"></i>behance</a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-5 sidebar game-page-sideber">
                    <div class="widget-sticky-container ">
                        <div class="widget-item">
                            <div class="rating-widget">
                                <h4 class="widget-title">Ratings</h4>
                                <ul>
                                    <li>Price<span>3.5/5</span></li>
                                    <li>Graphics<span>4.5/5</span></li>
                                    <li>Levels<span>3.5/5</span></li>
                                    <li>Levels<span>4.5/5</span></li>
                                    <li>Dificulty<span>4.5/5</span></li>
                                </ul>
                                <div class="rating">
                                    <h5><i>Rating</i><span>4.5</span> / 5</h5>
                                </div>
                            </div>
                        </div>
                        <div class="widget-item">
                            <div class="testimonials-widget">
                                <h4 class="widget-title">Testimonials</h4>
                                <div class="testim-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolo re magna aliqua. Quis ipsum suspend isse ultrices.</p>
                                    <h6><span>James Smith,</span>Gamer</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Games end-->


    @if (Auth::check() && Auth::user()->id === $postAuthor->id)
        {{-- A LINK TO EDIT FORM  --}}
        {{ link_to_route("posts.edit", __("Edit Post"), ['post' => $post->slug],
            [
                'class' => 'btn'
            ])
        }}

        {{-- A LINK TO DELETE THIS POST --}}
        {!! Form::open(
            [
                'route' => ['posts.destroy', 'post' => $post->slug],
                'method' => 'delete'
        ]) !!}
        {!! Form::submit(__("Delete post"), ['class' => 'btn-danger']) !!}
        {!! Form::close() !!}
    @endif

    <section class="game-author-section">
        <div class="container">
            <div class="game-author-pic set-bg" data-setbg="{{ asset('images/new_theme/author.jpg') }}"></div>
            <div class="game-author-info">
                <h4>Written by: {{ $post->user->name }}</h4>
                <p>Vivamus volutpat nibh ac sollicitudin imperdiet. Donec scelerisque lorem sodales odio ultricies, nec rhoncus ex lobortis. Vivamus tincid-unt sit amet sem id varius. Donec elementum aliquet tortor. Curabitur justo mi, efficitur sed eros alique.</p>
            </div>
        </div>
    </section>


    <!-- Newsletter section -->
    <section class="newsletter-section">
        <div class="container">
            <h2>Subscribe to our newsletter</h2>
            <form class="newsletter-form">
                <input type="text" placeholder="ENTER YOUR E-MAIL">
                <button class="site-btn">subscribe  <img src="{{ asset('images/icons/double-arrow.svg') }}" alt="#"/></button>
            </form>
        </div>
    </section>
    <!-- Newsletter section end -->
@endsection
