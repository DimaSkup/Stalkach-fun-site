@extends('layouts.theme')

@section('js')
    <script src="{{ asset('js/posts-featured.js') }}"></script>
@endsection

@section('content')
    <div class="content-container gradient-background">
        @include('posts._categories-menu')
        @include('posts._featured-carousel', ['featuredPosts' => $featuredPosts])

        <section class="featured-wrapper">
            @foreach($featuredPosts as $post)
                @if($loop->index === 0)
                    @include('posts.blocks._post-primary-block', ['post' => $post])
                @else
                    @include('posts.blocks._post-block', ['post' => $post])
                @endif
            @endforeach
            <div class="most-popular">
                @foreach($popularPosts as $post)
                    @include('posts.blocks._post-compact-block', [
                        'post' => $post,
                        'isReverse' => true,
                    ])
                @endforeach
            </div>
        </section>

        @isset($postsByCategories)
            @foreach($postsByCategories as $item)
                @if($item->get('posts')->isNotEmpty())
                    @include('posts._category-section', [
                        'category' => $item->get('category'),
                        'posts' => $item->get('posts'),
                    ])
                @endif
            @endforeach
        @endif
    </div>

    @include('sections.video', ['videoData' => $trailerVideoData])
    @include('sections.hot-post')
    @include('sections.intro')
    @include('sections.newsletter')
    @include('sections.support-ukraine', ['class' => 'mirrored-gradient-bg'])
@endsection
