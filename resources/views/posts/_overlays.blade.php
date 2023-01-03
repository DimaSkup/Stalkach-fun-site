@if($post->is_ad)
    <div class="overlay">
        <div class="ad">Adv</div>
    </div>
@endif

{{--        <div class="overlay">--}}
{{--            <div class="live">Live</div>--}}
{{--        </div>--}}

@if($post->type === App\Models\Post::TYPE_VIDEO)
    <div class="play-btn-overlay">
        <div class="play-btn">
            <span class="material-icons">play_arrow</span>
        </div>
    </div>
@endif