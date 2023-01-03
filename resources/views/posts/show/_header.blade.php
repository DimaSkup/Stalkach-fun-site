<div class="post-header" style="background-image: url('{{ $post->main_image }}')">
    <div class="post-category-badge">{{ $post->category->name }}</div>
    <h1>{{ $post->title }}</h1>
    <div class="post-meta">
        <div class="date"><time>{{ $post->created_full_time }}</time></div>
        <div class="views">{{ $post->views }}</div>
        <div class="read-time">{{ $post->duration }} min</div>
    </div>
    @if($post->source_url)
        <a class="post-author" href="{{ $post->author->get('url') }}" target="_blank">
            <div class="nickname">{{ $post->author->get('title') }}</div>
        </a>
    @else
        <div class="post-author">
            @include('includes.user-modal', ['user' => $post->user])
        </div>
    @endif
</div>