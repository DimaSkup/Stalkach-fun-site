{{-- HERE YOU CAN LOOK FOR SOME MODIFICATION BY FILTERS --}}

<section class="browse-mods">
    <h2>Browse mods</h2>
    <form class="filters" method="GET" name="browse-mods">
        <div class="left-side">
            <div class="s-group s-search ">
                <input class="s-control"
                       type="search"
                       name="search-mod"
                       id="search-mod"
                       placeholder="Search"
                >
            </div>
            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Shadow of Chernobyl">
                        <img src="{{ asset('images/icons/games/soc.ico') }}">
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Clear Sky">
                        <img src="{{ asset('images/icons/games/cs.ico') }}">
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Call of Pripyat">
                        <img src="{{ asset('images/icons/games/cop.ico') }}">
                    </div>
                </label>
            </div>

            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With new story">
                        <span class="material-icons">auto_stories</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Graphic improvements">
                        <span class="material-icons">add_photo_alternate</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Bestsellers">
                        <span class="material-icons">star_border</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With voice acting">
                        <span class="material-icons">mic</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With new guns">
                        <span class="material-icons">backpack</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="For old computers">
                        <span class="material-icons">speed</span>
                    </div>
                </label>
            </div>

            <div class="s-group">
                <select class="s-control" name="city" id="city">
                    <option>All categories</option>
                    <option>Berlin</option>
                    <option>Kyiv</option>
                    <option>Lviv</option>
                    <option>Herson</option>
                </select>
            </div>

            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                           checked
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="All difficults">
                        <span class="material-icons">emergency</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Hard difficult">
                        <span class="material-icons red">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Medium difficult">
                        <span class="material-icons yellow">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Easy difficult">
                        <span class="material-icons blue">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="For novices">
                        <span class="material-icons green">trip_origin</span>
                    </div>
                </label>
            </div>
        </div>
        <div class="right-side">
            <div class="s-mini-loader"></div>
        </div>
    </form>


    <div class="grid">
        @foreach(array_fill(1, 30, 1) as $key => $item)
            <a href="#" class="mod-item">
                <div class="cover">
                    <img src="https://picsum.photos/700/900?random={{ $key }}" alt="">
                    <div class="metadata">
                        <div class="left-side">
                            <div class="difficulty">
                                @if($key % 2 == 0)
                                    <span class="material-icons green">trip_origin</span>
                                @elseif($key % 3 == 0)
                                    <span class="material-icons blue">trip_origin</span>
                                @elseif($key % 5 == 0)
                                    <span class="material-icons yellow">trip_origin</span>
                                @else
                                    <span class="material-icons red">trip_origin</span>
                                @endif
                            </div>
                        </div>
                        <div class="right-side">
                            @php($r = random_int(0, 100))
                            @if($r % 2 == 0)
                                <div>
                                    <span class="material-icons">backpack</span>
                                </div>
                            @endif
                            @if($r % 3 == 0)
                                <div>
                                    <span class="material-icons">speed</span>
                                </div>
                            @endif
                            @if($r % 7 == 0)
                                <div>
                                    <span class="material-icons">add_photo_alternate</span>
                                </div>
                            @endif
                            @if($r % 5 == 0)
                                <div>
                                    <span class="material-icons">star_border</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="title">Lost in the Zone</div>
                    @if($key % 2 == 0)
                        <small class="subinfo">
                            <img src="{{ asset('images/icons/games/cop.ico') }}">
                            <span>Call of Pripyat</span>
                        </small>
                    @elseif($key % 3 == 0)
                        <small class="subinfo">
                            <img src="{{ asset('images/icons/games/cs.ico') }}">
                            <span>Clear Sky</span>
                        </small>
                    @else
                        <small class="subinfo">
                            <img src="{{ asset('images/icons/games/soc.ico') }}">
                            <span>Shadow of Chernobyl</span>
                        </small>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</section>