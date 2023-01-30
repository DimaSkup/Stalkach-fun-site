{{--
    COMPONENTS:

    differents filters
--}}

<b>Mix categories</b>
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


        {{-- DROPDOWN MENU --}}
        <div class="s-group">
            <select class="s-control" name="city" id="city">
                <option>All categories</option>
                <option>Berlin</option>
                <option>Kyiv</option>
                <option>Lviv</option>
                <option>Herson</option>
            </select>
        </div>


</form>
