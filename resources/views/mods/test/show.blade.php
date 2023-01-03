@extends('layouts.theme')

@section('content')
    <section class="modification-single-page">
        <div>
            {{-- back to the mods page --}}
            <a href="{{ route('mods') }}">{{ __('Back_to_mods') }}</a>

            {{----------------------- MAIN DATA AND MAIN IMAGE -------------------------}}
            <h1>{{__('Modification name')}}: {{ $modification->name }} </h1>
            <img src="{{ asset($modification->main_image) }}" alt="modification_main_image">
            <hr>

            {{------------------------------ GALLERY VIDEO ------------------------}}
            @if ($modification->galleryVideoUrl)
                {{-- <img src="{{ asset($modification->galleryVideoImage) }}" alt="mod_gallery_video_preview"> --}}
                <h1>GALLERY VIDEO:</h1>
                <a data-fslightbox="gallery" href="http://localhost:8000/video/333.mp4"><div class="vsc-controller"></div>
                    <video autoplay="" loop="" muted="" poster="http://localhost:8000/img/333.jpeg" id="background">
                        <source src="{{ $modification->galleryVideoUrl }}" type="video/mp4">
                    </video>
                </a>
            @endif

            {{----------------------------- CREATED AT / TAGS ------------------------------}}
            <div>
                {{ $modification->created_at }} / {{ __("in") }}
                @foreach($modification->tags as $tag)
                    <a href="{{ $tag->routeSearchByTag }}">{{ $tag->name }}</a>
                @endforeach
            </div>
            <hr>

            <div>
                <h2>{{ __('Description') }}:</h2>
                {{ $modification->description }}
            </div>

            {{------------------------------ SCREENSHOTS ------------------------------}}
            <div>
                <h2>{{ __('Screenshots') }}:</h2>
                @foreach($modification->screenshots as $screenshot)
                    <img src="{{ asset($screenshot) }}" width="300px" alt="screenshot">
                @endforeach
            </div>
            <hr>

            {{------------------------------ BOXART ------------------------------}}
            <div>
                <h2>{{ __('Boxart') }}:</h2>
                    <img src="{{ asset($modification->boxartImage) }}"  alt="box_art_image">
            </div>
            <hr>

            {{------------------------------ BACKGROUND ------------------------------}}
            <div>
                <h2>{{ __('Background') }}:</h2>
                <img src="{{ asset($modification->backgroundImage) }}"  alt="background_image">
            </div>
            <hr>


            {{------------------------------ TRAILER (VIDEO) ------------------------------}}
            @if($modification->trailerVideoUrl)
                <div>
                    <h2>{{ __('Trailer video') }}:</h2>
                    <a href="{{ $modification->trailerVideoUrl }}">
                        <img src="{{ $modification->trailerVideoPreviewImage }}" alt="trailer_preview">
                    </a>
                </div>
            @endif

            {{------------------------------ REVIEW (VIDEO) ------------------------------}}
            @if($modification->reviewVideoUrl)
                <div>
                    <h2>{{ __('Review video') }}:</h2>
                    <a href="{{ $modification->reviewVideoUrl }}">
                        <img src="{{ $modification->reviewVideoPreviewImage }}" alt="review_preview">
                    </a>
                </div>
            @endif

            {{------------------------------ MOD REVIEWS ------------------------------}}
            <div>
                <h2>{{ __('Mod Reviews') }}:</h2>
                @foreach($modification->modReviews as $index => $modReview)
                    <span>Review #{{ $index }} by {{ $modReview->author->name }}</span>
                    <p>{{ $modReview->text }}</p>
                    <p>
                        <h6>Grades:</h6>
                        <ul>
                            @foreach ($modReview->rating()->grades as $gradeType => $grade)
                                <li>{{ $gradeType  }} :: {{ $grade }}</li>
                            @endforeach
                        </ul>
                    </p>
                    <hr>
                @endforeach
            </div>

            {{------------------------------ DOWNLOAD LINKS ------------------------------}}
            <div>
                <h2>Download links:</h2>
                @foreach($modification->downloadLinks as $sourceType => $downloadLink)
                    <p>
                        {{ $sourceType }} : <a href="{{ $downloadLink }}">{{$sourceType}}</a>
                    </p>
                @endforeach
            </div>
            <hr>



            {{---------------- EDIT AND DELETE THIS MODIFICATION PAGE ---------------------}}
            {{-- @include ('.mods.edit._edit-delete-buttons', ['modification' => $modification]) --}}
        </div>
    </section>
@endsection


