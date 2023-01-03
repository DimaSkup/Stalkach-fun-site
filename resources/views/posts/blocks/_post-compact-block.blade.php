<article class="article article--compact
    @isset($isReverse)
        {{ $isReverse ? 'reverse' : '' }}
    @endif
    @isset($classes)
        {{ is_array($classes) ? implode(' ', $classes) : $classes }}
    @endif
">
    <a href="{{ $post->url }}" class="thumb-img">
        @include('posts._overlays')
        <img src="{{ $post->main_image_square }}">
    </a>
    <div class="text">
        <a href="{{ $post->url }}">
            <h3>{{ $post->title }}</h3>
        </a>
        <div class="subtitle">
            <time datetime="2020-05-25 12:00:00">{{ $post->created_time }} ▶
                <a href="{{ $post->author->get('url') }}">{{ $post->author->get('title') }}</a>
            </time>
        </div>
    </div>
</article>