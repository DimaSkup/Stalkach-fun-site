{{--
    A SINGLE MODIFICATION PAGE
    (mini header)

    when scroll down and hide a main header
    there will show up a mini header which is
    sticked to the upper side of the page
--}}

<div class="mod-mini-header">

    {{-- common info: mod's avatar (main image), name, basic game, author name --}}
    @include ('mods.show.includes._mini_header_left_side')

    {{-- mod stats: rating, subscribers, and views --}}
    @include ('mods.show.includes._mini_header_right_side')
</div>