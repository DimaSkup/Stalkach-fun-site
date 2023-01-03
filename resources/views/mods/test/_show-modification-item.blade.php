<div class="blog-item">
    <a href="{{ $modification->routeWithSlug }}" class="read-more">
    <div class="blog-thumb">
        <img src="{{ $modification->mainImage }}" alt="mod_main_image">
    </div>
    </a>
    <div class="blog-text text-box text-white">
        <div class="top-meta"> {{ $modification->created_at }}  / {{ __('in') }}
            @foreach ($modification->tags as $tag)
                <a href="{{ $tag->routeSearchByTag }}">{{ $tag->name }}</a>
            @endforeach
        </div>
        <h3>{{ $modification->name }}</h3>
        <p>{{ $modification->description }}</p>

        {{-- READ MORE BUTTON --}}
        <a href="{{ $modification->routeWithSlug }}" class="read-more">
            {{__('Read More')}}
            <img src="{{ asset('images/icons/double-arrow.svg') }}" alt="#"/>
        </a>
    </div>
</div>