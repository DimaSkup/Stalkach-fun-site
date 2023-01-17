@foreach(array_fill(1, 6, 1) as $key => $item)
    <li class="splide__slide mod-info">
        <h1>Lost in the Zone {{ $key }}</h1>
        <div class="mod-meta-block">
            <div>
                <a class="mod-game" href="#">
                    <div class="game-icon">
                        <img src="{{ asset('images/icons/games/cs.ico') }}">
                    </div>
                    <div>S.T.A.L.K.E.R: Clear Sky</div>
                </a>
            </div>
            <div>
                <a href="#">Dima Skyp</a>
            </div>
            <div class="mod-flags">
                <span class="material-icons" data-mdb-toggle="tooltip" title="With new guns">backpack</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With high performance">speed</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With voice acting">mic</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="Best of the best">star_border</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With new story">auto_stories</span>
            </div>
        </div>
        <p>Vestibulum vel diam non mi sodales consectetur id ac magna. Duis lobortis egestas ipsum, id venenatis justo dictum in. Mauris commodo, dolor et mattis venenatis, mauris felis mattis urna, ut tincidunt dolor tellus eget urna.</p>
        <a href="#" class="btn primary">Open modification</a>
    </li>
@endforeach