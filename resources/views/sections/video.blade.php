<!-- Intro section -->
<section class="intro-video-section"
         data-role="video-section"
         data-video-id="{{ $videoData['id'] }}"
>
    <div class="play-btn-overlay">
        <button class="play-btn video-popup action--play" data-action="open-video">
            <span class="material-icons">play_arrow</span>
        </button>
    </div>
    <div class="container">
        <div class="video-text">
            <h2>{{ $videoData['videoTitle'] }}</h2>
            <p>{{ $videoData['description'] }}</p>
        </div>
    </div>

    <div class="video-wrap">
        <div class="video-inner">
            <div class="video-iframe-wrapper">
                <div id="video-player"></div>
            </div>

            <button class="video-close-btn" data-action="close-video">
                <span class="material-icons">close</span>
            </button>
        </div>
    </div>
</section>