{{--
    A SINGLE MODIFICATION PAGE
    (main template)
--}}

@extends('layouts.theme')

@section('js')
    <script src="{{ asset('js/mod-page.js') }}"></script>
@endsection

@section('content')
    <section class="mod">
        @include ('mods.show.includes._header', ['mod' => $mod])
        @include ('mods.show.includes._mini_header')
        @include ('mods.show.includes._menu_navigation')

        {{-- SECTIONS OF THE MOD'S NAVIGATION MENU --}}
        <div class="splide mod-section">
            <div class="splide__track">
                <ul class="splide__list">
                    @include ('mods.show.includes._mod_section_description')
                    @include ('mods.show.includes._mod_section_reviews')
                    @include ('mods.show.includes._mod_section_faq')
                    @include ('mods.show.includes._mod_section_changelog')
                </ul>
            </div>
        </div>
    </section>
@endsection