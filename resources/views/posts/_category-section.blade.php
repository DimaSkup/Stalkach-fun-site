<section class="category-featured">
    <div class="header-wrapper">
        <h2 class="alt">{{ $category->name }}</h2>
        @if($posts->count() > 3)
            <a href="{{ $category->url }}" class="link-next">@lang('ui.category.section.more_category_posts')</a>
        @endif
    </div>

    <div class="body-wrapper">
        @foreach($posts as $post)
            @include('posts.blocks._post-block', ['post' => $post])
        @endforeach
    </div>
</section>