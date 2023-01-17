{{--
    (MAIN MODS PAGE)
    a section with browsing of modifications
    (the third part of the main page which contains a searching for modifications
    using filters and filtered modifications by such filters)
--}}

<section class="browse-mods">
    <h2>Browse mods</h2>

    {{-- SET UP FILTERS FOR SEARCHING A PARTICULAR MODIFICATION --}}
    @include ('mods.includes._index_browse_mods_searching_form')

    {{-- RESULTS BY SEARCHING FILTERS --}}
    @include ('mods.includes._index_browse_mods_filtered_mod_items', ['filteredMods' => $filteredMods])
</section>