{{--
    A SINGLE MODIFICATION PAGE
    (mini header)

    common info: mod's avatar (main image), name, basic game, author name
--}}

<div class="left-side">
    <div class="main-image">
        <img src="{{ $mod->mainImage }}">
    </div>
    <div class="title">
        <div class="header">
            {{ $mod->name }}
        </div>
        <div class="meta-block">
            <a class="game" href="#">
                <div class="game-icon">
                    <img src="{{ $mod->basicGameIcoPath }}">
                </div>
                <div>{{ $mod->basicGameName }}</div>
            </a>
            &bull;
            <a class="author" href="#">{{ $mod->author->name }}</a>
        </div>
    </div>
</div>