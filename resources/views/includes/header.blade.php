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
    <button class="btn secondary upper">@lang('ui.header.login_button')</button>
</div>
{{--<auth-component></auth-component>--}}

{{--<div class="user-panel">--}}

    {{-- Here we check if this user is an authenticated user --}}
{{--    @auth--}}
{{--        --}}{{-- if so we'll greet this user --}}
{{--        <div class="">--}}
{{--            <a href="#">Welcome to hell, {{ Auth::user()->name }}!&nbsp;&nbsp;</a>--}}
{{--        </div>--}}
{{--        <div class="">--}}
{{--            <a href="{{ route('logout') }}"--}}
{{--               onclick="event.preventDefault();--}}
{{--                document.getElementById('logout-form').submit();">--}}
{{--                {{ __('Logout') }}&nbsp;&nbsp;--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        --}}{{-- a logout form (it's a link to the logout route) --}}
{{--        {!! Form::open([--}}
{{--                'route'     => 'logout',--}}
{{--                'method'    => 'post',--}}
{{--                'id'        => 'logout-form'--}}
{{--        ]) !!}--}}
{{--        {{ csrf_field() }}--}}
{{--        {!! Form::close() !!}  --}}{{-- end of logout form--}}
{{--    @else--}}
{{--        --}}{{-- in another case: we'll show a login and a register route --}}
{{--        <div class="">--}}
{{--            <a href="{{ route('login') }}">{{ __('Login') }}&nbsp;&nbsp;</a>--}}
{{--        </div>--}}
{{--        <div class="">--}}
{{--            <a href="{{ route('register') }}">{{ __('Register') }}&nbsp;&nbsp;</a>--}}
{{--        </div>--}}
{{--    @endauth--}}

{{--    <a class="user-panel__avatar" href="#">--}}

{{--    </a>--}}
{{--    <button class="user-panel__nickname">--}}
{{--        <div class="username">Skiff</div>--}}
{{--        <span class="material-icons">expand_more</span>--}}
{{--    </button>--}}
{{--    <div class="notifications">--}}

{{--    </div>--}}
{{--</div>--}}