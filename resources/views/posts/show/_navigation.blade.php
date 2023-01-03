<div class="post-navigation">
    <a href="{{ $post->category->url }}" class="link-prev">Back to list</a>
    <div class="breadcrumb">
        <a class="breadcrumb-item" href="{{ route('blog') }}">Posts</a>
        <a class="breadcrumb-item" href="{{ $post->category->url }}">{{ $post->category->name }}</a>
        <div class="breadcrumb-item">{{ $post->title }}</div>
    </div>
</div>