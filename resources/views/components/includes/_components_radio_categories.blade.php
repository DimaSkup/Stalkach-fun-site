{{--
    COMPONENTS:

    radio filters
--}}


<b>Radio categories</b>
<form class="filters" method="GET" name="browse-mods">
    <div class="left-side baseline">
        <div class="categories-container">
            <label>
                <input type="radio" class="category-item" name="content" value="all">
                <span>All</span>
            </label>
            <label>
                <input type="radio" class="category-item" name="content" value="post">
                <span>News</span>
            </label>
            <label>
                <input type="radio" class="category-item" name="content" value="mod">
                <span>Modifications</span>
            </label>
            <label>
                <input type="radio" class="category-item" name="content" value="media">
                <span>Media</span>
            </label>
            <label>
                <input type="radio" class="category-item" name="content" value="resourse">
                <span>Resources</span>
            </label>
            <label>
                <input type="radio" class="category-item" name="content" value="wiki">
                <span>Gamepedia</span>
            </label>
        </div>
    </div>



    {{-- FILTRATION BY DIFFICULTIES --}}
    <div class="right-side">
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
        <div class="s-mini-loader"></div>
    </div>
</form>

