@if(count($relatedPosts) > 0)
    <section class="recommendations content-container">
        <div class="header-wrapper">
            <h2 class="alt">Recommendations</h2>
    {{--        <a href="#" class="link-next">See more posts in category</a>--}}
        </div>
        <div class="body-wrapper">
            @foreach($posts as $post)
                @include('posts.blocks._post-block', ['post' => $post])
            @endforeach
        </div>
    </section>
@endif