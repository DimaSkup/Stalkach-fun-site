{{--
    (MAIN MODS PAGE)
    a list with top 10 mods today
    (inside the second carousel)
--}}

@foreach($top10Mods as $key => $mod)
    <li class="splide__slide">
        <a href="{{ $mod->url }}">

            {{-- mod image --}}
            <div class="cover">
                <img src="{{ $mod->boxartImage }}" alt="top_mod_boxart_image">

                {{-- a little square with the mod rate number --}}
                <div class="rating">
                    <b>{{ $key + 1 }}</b>
                </div>
            </div>

            {{-- some info about a modification --}}
            <div class="info">
                <div class="title">
                    {{ $mod->name }}
                </div>
                <small class="subinfo">
                    <span>
                        <img src="{{ $mod->basicGameIcoPath }}">
                        {{ $mod->basicGameName }}
                    </span>
                </small>
            </div>
        </a>
    </li>
@endforeach