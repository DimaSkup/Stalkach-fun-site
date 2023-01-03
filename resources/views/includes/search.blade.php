<div id="search">
    <div class="left-side">
        <div class="search-header">
            <div class="logo-wrapper">
                @include('includes.logo')
            </div>
            <button type="button"
                    class="close"
                    onclick="document.getElementById('search').classList.remove('active');
                    document.querySelector('body').classList.remove('overflow-hidden')">
                <span class="material-icons">close</span>
            </button>
        </div>

        <form id="search-form" method="GET" action="{{ route('search') }}">
            <div class="categories-container">
                <label>
                    <input type="radio" class="category-item" name="content-type" value="all" checked>
                    <span>@lang('ui.search.category.all')</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content-type" value="post">
                    <span>@lang('ui.search.category.news')</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content-type" value="mod">
                    <span>@lang('ui.search.category.modifications')</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content-type" value="media">
                    <span>@lang('ui.search.category.media')</span>
                </label>
{{--                <label>--}}
{{--                    <input type="radio" class="category-item" name="content-type" value="resourse">--}}
{{--                    <span>Resources</span>--}}
{{--                </label>--}}
{{--                <label>--}}
{{--                    <input type="radio" class="category-item" name="content-type" value="wiki">--}}
{{--                    <span>Gamepedia</span>--}}
{{--                </label>--}}
            </div>

            <div class="search-container">
                <button type="submit">
                    <span class="material-icons">search</span>
                </button>
                <input type="search" name="q" placeholder="@lang('ui.search.placeholder_form')">
            </div>

            <div class="tags-container">
                <div class="title">@lang('ui.search.popular.tags_title')</div>
                <div class="popular-tags">
                    <a class="popular-tag" href="#tag-name" data-id="1">Anomalies</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Music</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Mecheniy</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
                    <a class="popular-tag" href="#tag-name" data-id="1">Mecheniy</a>
                </div>
            </div>
        </form>
    </div>
{{-- RIGHT SIDE --}}
    <div class="right-side">
        <section>
            <div class="section-title">@lang('ui.search.popular.content_title')</div>
            <div class="section-wrapper">
                <div class="left-content-side">
                    <a href="#">
                        <div class="icon">
                            <span class="material-icons">report_problem</span>
                        </div>
                        <div class="title">Warning</div>
                        <div class="description">Maiores quia amet et dolores in</div>
                    </a>
                    <a href="#">
                        <div class="icon">
                            <span class="material-icons">report_problem</span>
                        </div>
                        <div class="title">Warning</div>
                        <div class="description">Maiores quia amet et dolores in</div>
                    </a>
                    <a href="#">
                        <div class="icon">
                            <span class="material-icons">report_problem</span>
                        </div>
                        <div class="title">Warning</div>
                        <div class="description">Maiores quia amet et dolores in</div>
                    </a>
                    <a href="#">
                        <div class="icon">
                            <span class="material-icons">report_problem</span>
                        </div>
                        <div class="title">Warning</div>
                        <div class="description">Maiores quia amet et dolores in</div>
                    </a>
                </div>
                <ul class="right-content-side">
                    <li>
                        <a href="#">
                            <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                            <div class="description">Maiores quia amet et dolores in. Qui voluptas magni beatae temporibus. Iure debitis incidunt ut.</div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="title">Прохождение S.T.A.L.K.E.R: Clear Sky</div>
                            <div class="description">Est consequatur aspernatur autem aut. Nulla eveniet ab soluta neque ut.</div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="title">Скупейко: новый разработчик низкоуровневой архитектуры игры</div>
                            <div class="description">Quod quia sit totam error. Voluptas nihil sit molestias illo. Alias ut rerum sit.</div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                            <div class="description">Autem qui quis et quia. Maxime consequuntur doloremque</div>
                        </a>
                    </li>
                </ul>
            </div>

        </section>

        <section class="latest-posts">
            <div class="section-title">@lang('ui.search.latest.posts_title')</div>
            <a class="see-more" href="#">@lang('ui.search.latest.more_tag')<span class="material-icons">play_arrow</span></a>
            <div class="posts">
                <a href="#">
                    <div class="image">
                        <img src="https://images8.alphacoders.com/106/thumb-1920-1066487.jpg">
                    </div>
                    <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                    <div class="description">Autem qui quis et quia. Maxime consequuntur doloremque</div>
                </a>
                <a href="#">
                    <div class="image">
                        <img src="https://images8.alphacoders.com/106/thumb-1920-1066487.jpg">
                    </div>
                    <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                    <div class="description">Autem qui quis et quia. Maxime consequuntur doloremque</div>
                </a>
                <a href="#">
                    <div class="image">
                        <img src="https://images8.alphacoders.com/106/thumb-1920-1066487.jpg">
                    </div>
                    <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                    <div class="description">Autem qui quis et quia. Maxime consequuntur doloremque</div>
                </a>
                <a href="#">
                    <div class="image">
                        <img src="https://images8.alphacoders.com/106/thumb-1920-1066487.jpg">
                    </div>
                    <div class="title">Дневник сталкера-блондинки. Чистое небо.</div>
                    <div class="description">Autem qui quis et quia. Maxime consequuntur doloremque</div>
                </a>
            </div>
        </section>
    </div>
</div>