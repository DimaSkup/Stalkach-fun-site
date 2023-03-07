{{--
    CONTAINS LOGIN-LOGOUT BUTTON LOGIC
--}}

{{-- Here we check if this user is an authenticated user --}}
    @auth
        {{-- user upper menu button (implemented by using mdb-ui-kit (bootstrap)) --}}
        <button
                class="btn btn-icon"
                type="button"
                id="userUpperMenu"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
        >
            <span class="username">{{ Auth::user()->name }}</span>

            {{-- user's avatar --}}
            <span class="avatar">
                <img src="{{ Auth::user()->avatar }}" width="32" height="32" alt="user_avatar_image">
            </span>

            <span class="material-icons">expand_more</span>
        </button>

        {{-- user upper menu elements list --}}
        <ul class="user-upper-menu dropdown-menu">
            <li>
                <a class="dropdown-item" href="{{ route('user.show', ['user' => Auth::user()->id]) }}">{{ __('User page') }}</a>
            </li>
            <li>
                {{-- notifications for the user --}}
                <a class="dropdown-item" href="#">Notifications</a>
            </li>
            <li>
                {{-- a logout button --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                {{-- a logout form (it's a link to the logout route) --}}
                {!! Form::open([
                        'route'     => 'logout',
                        'method'    => 'post',
                        'id'        => 'logout-form'
                ]) !!}
                {{ csrf_field() }}
                {!! Form::close() !!}   {{-- end of logout form --}}

            </li>
        </ul>


    {{-- in another case: we'll show a LOGIN and a REGISTER buttons --}}
    @else

        <button class="btn secondary upper">
            <a href="{{ route('login') }}">@lang('ui.header.login_button')</a>
        </button>
        <button class="btn secondary upper">
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </button>
    @endauth