<div class="">
    <ul class="">
        @foreach ($content['posts'] as $post)
            <li class="">

                {{-- a link to the page with this post --}}
                <a href="{{ route('posts.show', $post->slug) }}">

                    {{-- the post image --}}
                    <img src="{{ $post->image }}" width="720" height="480" alt="post_image">

                    {{-- the reading/watching post duration --}}
                    <div class=:">{{ $post->duration }} {{__('min')}}</div>

                    <div class="">
                        {{-- an authors name --}}
                        <div class="">
                            <span>{{ $post->author }}</span>
                        </div>

                        {{-- an author avatar --}}
                        <div class="">
                        </div>

                        <div class="">{{ $post->title }}</div>
                        <div class=""> {{ $post->views }} {{__('views')}} &bull; {{ $post->created_at }}</div>
                    </div>
                </a>

                <hr>
            </li>
        @endforeach
    </ul>
</div>