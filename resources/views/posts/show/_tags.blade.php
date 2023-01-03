<div class="tags">
    @foreach($post->tags as $tag)
        <a class="popular-tag" href="{{ $tag->url }}" data-id="1">{{ $tag->name }}</a>
    @endforeach
</div>