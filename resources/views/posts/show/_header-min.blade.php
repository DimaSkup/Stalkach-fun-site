<div class="post-header-min">
    <h1>{{ $post->title }}</h1>
    <div class="post-meta">
        @if($post->source_url)
            <a class="post-author" href="{{ $post->author->get('url') }}" target="_blank">
                <div class="nickname">{{ $post->author->get('title') }}</div>
            </a>
        @else
            <div class="post-author">
                @include('includes.user-modal', ['user' => $post->user])
            </div>
        @endif
        <div class="date"><time>{{ $post->created_full_time }}</time></div>

        @if($post->views)
        <div class="views">{{ $post->views }}</div>
        @endif

        @if($post->duration)
            <div class="read-time">{{ $post->duration }} min</div>
        @endif
    </div>
</div>