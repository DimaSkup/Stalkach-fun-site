{{--
    (MAIN MODS PAGE)
    RESULTS BY SEARCHING FILTERS
    (a list with modifications which were filtered by particular parameters)
--}}

<div class="grid">
    @foreach($filteredMods as $mod)
        <a href="{{ $mod->url }}" class="mod-item">

            {{-- a modification boxart image and some metadata --}}
            <div class="cover">
                <img src="{{ $mod->boxartImage }}" alt="mod_box_art_image">
                <div class="metadata">
                    <div class="left-side">
                        <div class="difficulty">
                            <span class="material-icons green">trip_origin</span>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="features">
                            <span class="material-icons">backpack</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- mod name and some info about basic game version--}}
            <div class="info">
                <div class="title">{{ $mod->name }}</div>
                <small class="subinfo">
                    <img src="{{ $mod->basicGameIcoPath }}">
                    <span>{{ $mod->basicGameName }}</span>
                </small>
            </div>
        </a>
    @endforeach
</div>