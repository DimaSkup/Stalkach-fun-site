<div class="hot-news">
    @foreach($hotPosts as $post)
        <article class="article article--compact reverse">
            <a href="{{ $post->url }}" class="thumb-img">
                <img src="{{ $post->main_image_square }}">
            </a>
            <div class="text">
                <a href="{{ $post->url }}">
                    <h3>{{ $post->title }}</h3>
                </a>
                <div class="subtitle">
                    <time datetime="{{ $post->created_at }}">
                        {{ $post->created_time }} ▶ <a href="{{ $post->author->get('url') }}">{{ $post->author->get('title') }}</a>
                    </time>
                </div>
            </div>
        </article>
    @endforeach
</div>