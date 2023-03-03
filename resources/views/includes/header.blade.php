{{--<button class="search-button" onclick="document.getElementById('search').classList.add('active'); document.body.style.overflowY = 'hidden'">--}}
{{--    <span class="material-icons">search</span>--}}
{{--    <b>Search</b>--}}
{{--</button>--}}

<button class="btn btn-with-icon link"
        onclick="document.getElementById('search').classList.add('active');
                document.querySelector('body').classList.add('overflow-hidden')">
    <span class="material-icons">search</span>
    <span class="text">@lang('ui.header.search_button')</span>
</button>

<div class="dropdown">
    @include('includes.language-switcher')
    @include('includes.login-logout')
</div>