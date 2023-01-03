<div class="gallery">
    @foreach($galleryPosts as $post)
        <h1>MAIN IMAGE:</h1>
            <img src="{{ $post->mainImage }}" width="480" alt="gallery_main_image">
        <h1>MASTHEAD:</h1>
            <img src="{{ $post->mastheadImage }}" width="480" alt="gallery_masthead">
        <span>SQUARE:</span>
                <img src="{{ $post->mainImageSquare }}" alt="post_main_image_square">
        <span>ALBUM:</span>
                <img src="{{ $post->mainImageAlbum }}" alt="post_main_image_album">
        <h1>GALLERY:</h1>
            @foreach($post->galleryImages as $galleryImageUrl)
                <img src="{{ $galleryImageUrl }}" width="480" alt="gallery_gallery_image">
            @endforeach
        <br>
        <hr>
    @endforeach
</div>