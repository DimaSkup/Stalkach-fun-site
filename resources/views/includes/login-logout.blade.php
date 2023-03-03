{{--
    CONTAINS LOGIN-LOGOUT BUTTON LOGIC
--}}
<script src="{{ asset('js/pages/user-menu.js') }}"></script>

{{-- Here we check if this user is an authenticated user --}}
    @auth
        <button class="user-dropdown-menu">
        {{--            <a href="{{ route('user.show', ['user' => Auth::user()->id]) }}">{{ Auth::user()->name }}!&nbsp;&nbsp;</a>--}}
            <div class="title">
                <div class="username">{{ Auth::user()->name }}</div>
                <span class="material-icons">expand_more</span>
            </div>



            <div class="user-dropdown-menu-content">
                {{-- user's avatar --}}
                <div class="user-panel__avatar">
                    <img src="{{ Auth::user()->avatar }}" width="32" height="32" alt="user_avatar_image">
                </div>

                <div class="user-dropdown-menu-elem">
                    <a href="{{ route('user.show', ['user' => Auth::user()->id]) }}">{{ __('User page') }}</a>
                </div>

                {{-- notifications for the user --}}
                <div class="user-dropdown-menu-elem">
                    <a href="#">Notifications</a>
                </div>

                {{-- a logout button --}}
                <div class="user-dropdown-menu-elem">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>

            </div>
        </button>


        {{-- a logout form (it's a link to the logout route) --}}
        {!! Form::open([
                'route'     => 'logout',
                'method'    => 'post',
                'id'        => 'logout-form'
        ]) !!}
        {{ csrf_field() }}
        {!! Form::close() !!}   {{-- end of logout form --}}


    {{-- in another case: we'll show a LOGIN and a REGISTER buttons --}}
    @else

        <button class="btn secondary upper">
            <a href="{{ route('login') }}">@lang('ui.header.login_button')</a>
        </button>
        <button class="btn secondary upper">
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </button>
    @endauth