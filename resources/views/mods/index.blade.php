{{--
    MODS MAIN PAGE (MAIN TEMPLATE)
--}}

@extends('layouts.theme')

@section('js')
    <script src="{{ asset('js/mods-index.js') }}"></script>
@endsection

@php
    $legacyMode = false;
@endphp

@section('content')
    <div class="content-container mods">
        {{-- a section with the list of recent mods (carousel with mods + some info about each mod) --}}
        @include ('mods.includes._index_recent_mods', ['latestMods' => $latestMods])

        {{-- a section with the list with top 10 mods today --}}
        @include ('mods.includes._index_top_10_mods_today', ['top10Mods' => $latestMods])
    </div>


    {{-- LOOKING FOR some modification by filters --}}
    <div class="content-container gradient-background">

        @if ($legacyMode)
            @include ('mods.includes.legacy._index_browse_mods')
        @else
            @include ('mods.includes._index_browse_mods', ['filteredMods' => $filteredMods])
        @endif
    </div>
@endsection