<template>
    <div id="search">
        <div class="left-side">
            <div class="search-header">
                <div class="logo-wrapper">
                    <a class="logo" href="/">
                        <img :src="logo">
                        <span>s2game.ru</span>
                    </a>
                </div>
                <button class="close" v-on:click="close">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="types-container">
                <a class="content-type" href="#">
                    All
                </a>
                <a class="content-type" href="#">
                    News
                </a>
                <a class="content-type active" href="#">
                    Modifications
                </a>
                <a class="content-type" href="#">
                    Media
                </a>
                <a class="content-type" href="#">
                    Resources
                </a>
                <a class="content-type" href="#">
                    Gamepedia
                </a>
            </div>
            <div class="search-container">
                <button type="submit">
                    <span class="material-icons">search</span>
                </button>
                <input type="search" name="search" placeholder="Monolith, ComicsCon, Anomalies, ...">
            </div>
            <div class="tags-container">
                <div class="title">Popular tags</div>
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
        </div>

        <div class="right-side">
            <section>
                <div class="section-title">Popular content</div>
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
                <div class="section-title">Latest posts</div>
                <a class="see-more" href="#">See more on the blog <span class="material-icons">play_arrow</span></a>
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
</template>

<script>
    export default {
        data() {
            return {
                logo: '/svg/logo.svg',
                categories: ['']
            };
        },
        methods: {
            close: (event) => {
                document.getElementById('search').classList.remove('active');
                document.body.style.overflowY = 'auto';
            }
        }
    }
</script>

<style lang="scss">
    @import "../../sass/includes/search";
</style>
