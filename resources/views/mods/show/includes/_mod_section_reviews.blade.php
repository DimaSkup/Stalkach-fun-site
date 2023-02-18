<li class="mod-section-slide splide__slide" data-slide-id="reviews">
    <div class="reviews-wrapper">
        <div class="reviews-list">

            @foreach ($mod->modReviews as $modReview)
                <div class="review-block">
                    <div class="author">
                        <div class="avatar">
                            <img src="{{ $modReview->author->avatar }}">
                        </div>
                        <div class="title">{{ $modReview->author->name }}</div>
                    </div>
                    <div class="content">
                        {{ $modReview->text }}
                    </div>
                </div>
            @endforeach
        </div>


        <div class="reviews-sidebar">
            <div class="rating-section">
                @php
                    $ratingData = [
	                    ['story' => "Story",        'score' => "7.4/10"],
	                    ['story' => "Graphic",      'score' => "7/10"],
	                    ['story' => "Difficulty",   'score' => "5.4/10"],
	                    ['story' => "Optimisation", 'score' => "8.4/10"],
	                    ['story' => "Atmosphere",   'score' => "9.1/10"],
	                    ['story' => "Summary",      'score' => "6.4/10"],
                    ];
                @endphp

                @foreach($ratingData as $data)
                    <div class="rating-category">
                        <div class="title">{{ $data['story'] }}</div>
                        <div class="score">{{ $data['score'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>