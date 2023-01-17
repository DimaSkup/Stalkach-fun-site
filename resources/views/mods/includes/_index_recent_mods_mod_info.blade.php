{{--
    SOME INFO ABOUT A RECENT MODIFICATION
--}}

@foreach ($latestMods as $key => $mod)
    <li class="splide__slide mod-info">
        <h1>{{ $mod->name }}</h1>

        <div class="mod-meta-block">

            {{-- after each div in mod-meta-block we have content: "•" (look at css styles to it)--}}
            <div>
                {{-- basic game version ico and its name --}}
                <a class="mod-game" href="#">
                    <div class="game-icon">
                        <img src="{{ $mod->basicGameIcoPath }}" alt="mod_base_ico">
                    </div>
                    <div>{{ $mod->basicGameName }}</div>
                </a>
            </div>

            {{-- mod author --}}
            <div>
                <a href="#">{{ $mod->author->name }}</a>
            </div>

            {{-- flags about modification features --}}
            <div class="mod-flags">
                <span class="material-icons" data-mdb-toggle="tooltip" title="With new guns">backpack</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With high performance">speed</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With voice acting">mic</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="Best of the best">star_border</span>
                <span class="material-icons" data-mdb-toggle="tooltip" title="With new story">auto_stories</span>
            </div>

            {{-- a description of the modification --}}
            <p>{{ $mod->description }}.</p>
            <a href="{{ $mod->url }}" class="btn primary">Open modification</a>
        </div>
    </li>
@endforeach