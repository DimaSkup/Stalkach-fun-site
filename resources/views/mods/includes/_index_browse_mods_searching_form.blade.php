{{--
    SET UP FILTERS FOR SEARCHING A PARTICULAR MODIFICATION
--}}

@php
    $modFeaturesList = \App\Models\Mod::MOD_FEATURES_LIST;
    $basicGameNamesList = \App\Models\Mod::GAME_NAMES;
    $modDifficultiesList = \App\Models\Mod::MOD_DIFFICULTIES_LIST
@endphp

<form class="filters" method="GET" name="browse-mods">
    <div class="left-side">

        {{-- filtration by name --}}
        <div class="s-group s-search">
            <input class="s-control"
                   type="search"
                   name="search-mod"
                   id="search-mod"
                   placeholder="Search"
            >
        </div>

        {{-- filtration by a basic game version (soc, cs, cop, hoc) --}}
        <div class="s-group">
            @foreach ($basicGameNamesList as $key => $gameName)
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="filter_by_{{ $gameName }}"
                           id="filter_by_{{ $gameName }}"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="{{ $gameName }}">
                        <img src="{{ \App\Models\Mod::getPathToIcoImageByKey($key) }}">
                    </div>
                </label>
            @endforeach
        </div>


        {{--
            filtration by modification features
            (new story, voice acting, graphic improvement, etc)
        --}}
        <div class="s-group">
            @foreach ($modFeaturesList as $key => $featureData)
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="filter_by_{{$key}}"
                           id="filter_by{{$key}}"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="{{ $featureData['text'] }}">
                        <span class="material-icons">{{ $featureData['icon_name'] }}</span>
                    </div>
                </label>
            @endforeach
        </div>


        {{--
        <div class="s-group">
            <select class="s-control" name="city" id="city">
                <option>All categories</option>
                <option>Berlin</option>
                <option>Kyiv</option>
                <option>Lviv</option>
                <option>Herson</option>
            </select>
        </div>
        --}}

        {{-- filtration by difficulty --}}
        <div class="s-group">
            @foreach ($modDifficultiesList as $key => $data)
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="{{$key}}"
                           id="{{$key}}"
                           @if ($loop->first) checked @endif {{-- the first element "all difficulties" must be chosen after loading of the page --}}
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="{{ $data['text'] }}">
                        <span class="material-icons {{$data['icon_color']}}">
                            {{ $data['icon_name'] }}
                        </span>
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    {{-- I don't know what is it --}}
    <div class="right-side">
        <div class="s-mini-loader"></div>
    </div>
</form>