<div class="show">
    @foreach($latestPosts as $post)
        <h1>{{$var}}</h1>
        <p>
            <h1>{{ $post->title }}</h1>

        <h2>MAIN IMAGE:</h2>
            <img src="{{ $post->mainImage }}" alt="post_main_image">
        <h1>SQUARE:</h1>
            <img src="{{ $post->mainImageSquare }}" alt="post_main_image_square">
        <br>
    @endforeach
</div>