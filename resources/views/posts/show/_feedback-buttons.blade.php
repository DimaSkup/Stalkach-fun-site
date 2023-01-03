<div class="share-post">
    <div class="btn-share">
        <span class="btn-icon material-icons">share</span>
        <span class="btn-text">Share</span>
        <ul class="social-icons">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($post->url) }}" target="_blank">
                    <span class="socicon socicon-facebook"></span>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($post->title) }}" target="_blank">
                    <span class="socicon socicon-twitter"></span>
                </a>
            </li>
            <li>
                <a href="https://t.me/share/url?url={{ rawurlencode($post->url) }}&text={{ rawurlencode($post->title) }}" target="_blank">
                    <span class="socicon socicon-telegram"></span>
                </a>
            </li>
            <li>
                <button data-action='copy' data-clipboard-text="{{ $post->url }}">
                    <span class="material-icons">file_copy</span>
                </button>
            </li>
        </ul>
    </div>
    <button class="btn btn-with-icon like" onclick="this.classList.toggle('active'); this.querySelector('.text').innerText = this.classList.contains('active') ? 'Liked' : 'Like';">
        <span class="material-icons">favorite</span>
        <span class="text">Like</span>
    </button>
</div>