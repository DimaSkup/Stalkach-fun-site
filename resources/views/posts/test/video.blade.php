<div class="show">
    @foreach($videoPosts as $post)
        <p>
            <h1>{{ $post->title }}</h1>

        <h2>MAIN IMAGE:</h2>
            <img src="{{ $post->mainImage }}" alt="post_main_image">

        <span>SQUARE:</span>
            <img src="{{ $post->mainImageSquare }}" alt="post_main_image_square">

        <span>ALBUM:</span>
            <img src="{{ $post->mainImageAlbum }}" alt="post_main_image_album">

        <span>VIDEO:</span>
        <a href="{{ $post->videoUrl }}">
            <img src="{{ $post->mainImage }}" alt="post_main_image">
        </a>

        <br>
        <br>
        <div>
            <span>DESCRIPTION:</span>
            <p>{{ $post->description }}</p>
            <span>TEXT</span>
            <p>{{ $post->text }}</p>
        </div>

        <hr>
        <br>
        <hr>
    @endforeach
</div>