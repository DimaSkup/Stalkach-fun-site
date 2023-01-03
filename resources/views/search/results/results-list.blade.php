{{------------------ A LIST WITH ARTICLES BY A TAG OR QUERY ------------------}}
@if (!$isAnyResults)       {{-- if we have some popular data --}}
    <h1>THERE IS NO RESULTS BY THIS TAG :(</h1>
@elseif ($isPopularData)      {{-- if we have some data by a tag/query --}}
    <h1>POPULAR ON THE WEBSITE</h1>
@else                               {{-- we executed the searching by a tag which doesn't exist --}}
    <h1>THE SEARCHING RESULTS</h1>

    {{-- POSTS RESULTS --}}
    @include ('.search.results._post-results')

    {{-- MODS RESULTS --}}
    @include ('.search.results._mods-results')
@endif