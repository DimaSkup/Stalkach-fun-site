{{--
    A SINGLE MODIFICATION PAGE
    (header)
--}}

@php
    $downloadSourceFullNames = \App\Models\Mod::DOWNLOAD_SOURCES_TRANS
@endphp

<div class="mod-header">
    {{-- background images which are shown according to the carousel --}}
    @include ('mods.show.includes._header_background_images')

    {{-- some common info about the mod + a download links list --}}
    <div class="header-content">

        {{-- open the currently chosen screenshot --}}
        <button type="button" class="btn btn-icon secondary" id="open-lightbox">
            <span class="material-icons-outlined">aspect_ratio</span>
        </button>

        {{-- metadata, download/upload links --}}
        @include ('mods.show.includes._header_left_side', ['downloadSourceFullNames' => $downloadSourceFullNames])

        {{-- the current mod stats; a carousel --}}
        @include ('mods.show.includes._header_right_side')

    </div>
</div>