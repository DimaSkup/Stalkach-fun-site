{{--
    COMPONENTS:

    posts block
--}}


@php
/* prepare some data */

$postsTags = [
	'clear_sky', 'mod_community_newsfffffffffffffffff', 'GSC_news'
];
@endphp

<div class="row-demo">
    <div class="col-demo">
        <b>Posts block</b>
        <div class="posts-grid pb-5">
            @foreach($imgLinks as $key => $imageLink)
                <article class="article">
                    <a href="#" class="thumb-img">
                        <img src="{{ $imageLink }}">
                    </a>
                    <div class="text">
                        <div class="tags">
                            @foreach ($postsTags as $tag)
                                <a class="popular-tag" href="#tag-name" data-id="1">{{ $tag }}</a>
                            @endforeach
                        </div>
                        <a href="#">
                            <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                        </a>
                        <div class="subtitle">
                            <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>