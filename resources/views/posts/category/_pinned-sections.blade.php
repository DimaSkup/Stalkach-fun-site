@if($pinnedPosts->isNotEmpty())
    <section class="special-posts content-container">
        <div class="special-posts--header">
            <span class="decoration-line first-line"></span>
            <span class="material-icons">push_pin</span>
            <span class="header-text">@lang('ui.pined.posts_title')</span>
            <span class="decoration-line"></span>
        </div>
        <div class="special-posts--content">
            <div class="special-posts--posts">
                @foreach($posts as $post)
                    <article class="article">
                        <a href="{{ $post->url }}" class="thumb-img">
                            <img src="{{ $post->main_image_album }}">
                        </a>
                        <a href="{{ $post->url }}" class="text">
                            <h3>{{ $post->title }}</h3>
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="special-posts--info">
                @if($category->pinned_subtitle)
                    <b>{{ $category->pinned_subtitle }}</b>
                @endif
                <h2>{{ $category->pinned_title ?? trans('ui.pined.post_info') }}</h2>
                @if($category->pinned_description)
                    <p>{{ $category->pinned_description }}</p>
                @endif
            </div>
        </div>
    </section>
@endif