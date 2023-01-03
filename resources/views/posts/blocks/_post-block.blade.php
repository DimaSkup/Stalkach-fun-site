<article class="article
    @isset($classes)
        {{ is_array($classes) ? implode(' ', $classes) : $classes }}
    @endif
">
    <a href="{{ $post->url }}" class="thumb-img">
        @include('posts._overlays')
        <img src="{{ $post->main_image_album }}" alt="{{ $post->title . ' image' }}" loading="lazy">
    </a>
    <div class="text">
        <div class="tags">
            @if($post->tags->isNotEmpty())
                @foreach($post->tags as $tag)
                    <a class="popular-tag" href="#{{ $tag->name }}" data-id="{{ $tag->id }}">{{ $tag->name }}</a>
                @endforeach
            @endif
        </div>
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