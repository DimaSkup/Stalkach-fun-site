{{--
    A SINGLE MODIFICATION PAGE
    (header)

    metadata, download/upload links
--}}

<div class="left-side">

    {{-- mod name, basic game, author --}}
    <div class="title-block">
        <h1>{{ $mod->name }}</h1>
    </div>
    <div class="mod-meta-block">
        <a class="mod-game" href="#">
            <div class="game-icon">
                <img src="{{ $mod->basicGameIcoPath }}">
            </div>
            <div>{{ $mod->basicGameName }}</div>
        </a>
        <a href="#">
            {{ $mod->author->name }}
        </a>
    </div>

    {{-- DOWNLOAD / UPLOAD LINKS --}}
    <div class="links-block">

        {{-- the list with download source links --}}
        <div class="btn-group dropup">
            <button type="button" class="download-link btn primary">Download</button>
            <button
                    type="button"
                    class="btn primary dropdown-toggle dropdown-toggle-split"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
            >
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>

            {{-- download sources --}}
            <ul class="dropdown-menu">
                @foreach ($mod->downloadLinks as $sourceKey => $link)
                    <li>
                        <a class="dropdown-item with-icon" href="{{ $link }}" target="_blank">
                            <div class="icon">
                                <img src="{{ asset('images/icons/drivers/google-drive.svg') }}">
                            </div>
                            <div class="title">{{ __($downloadSourceFullNames[$sourceKey]) }}</div>
                        </a>
                    </li>
                @endforeach

                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item with-icon" href="#" target="_blank">
                        <div class="icon">
                            <span class="material-icons">downloading</span>
                        </div>
                        <div class="title">custom-site.com</div>
                    </a>
                </li>
            </ul>
        </div>

        {{--
            the list for uploading all the possible imporovements
            which can be made by the community
        --}}
        <div class="dropup">
            <button
                    class="btn btn-with-icon secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
            >
                <span class="material-icons">upload_file</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Fix with UI</a></li>
                <li><a class="dropdown-item" href="#">Graphic enhancement</a></li>
                <li><a class="dropdown-item" href="#">Save 100%</a></li>
            </ul>
        </div>
    </div>
</div>