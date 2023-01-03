<div class="sidebar">
    @include('includes.logo')

    <div class="navigation">
        <div class="navigation__title">@lang('ui.aside.navigation.menu')</div>
        <nav>
            {{---------------- MENU BUTTONS BLOCK -----------------}}
            @foreach($menu as $item)
                <a class="navigation__item {{ $item['active'] ? 'active' : '' }}" href="{{ $item['url'] }}"
                    {{--               data-mdb-toggle="tooltip"--}}
                    {{--               data-mdb-placement="right"--}}
                    {{--               title="Home"--}}
                >
                    <div class="navigation__wrapper">
                        <span class="icon material-icons">{{ $item['icon'] }}</span>
                        <div class="title">{{ $item['title'] }}</div>
                    </div>
                </a>
            @endforeach
        </nav>
        <hr>
        <div class="navigation__title">@lang('ui.aside.navigation.services')</div>
        <nav>
            @foreach($services as $item)
                <a class="navigation__item" href="#"
                    {{--               data-mdb-toggle="tooltip"--}}
                    {{--               data-mdb-placement="right"--}}
                    {{--               title="Home"--}}
                >
                    <div class="navigation__wrapper">
                        <div class="icon">
                            <span class="material-icons">{{ $item['icon'] }}</span>
                        </div>
                        <div class="title">{{ $item['title'] }}</div>
                    </div>
                </a>
            @endforeach
        </nav>
    </div>
{{--    <hr>--}}
{{--    <div class="services">--}}
{{--        --}}
{{--    </div>--}}
{{--    <hr>--}}

{{--    <div class="row-nav-wrapper">--}}
{{--        <div class="navigation__title">Society</div>--}}
{{--        <nav>--}}
{{--            <a href="#">--}}
{{--                <span class="icon socicon-telegram"></span>--}}
{{--            </a>--}}
{{--            <a href="#">--}}
{{--                <span class="icon socicon-instagram"></span>--}}
{{--            </a>--}}
{{--            <a href="#">--}}
{{--                <span class="icon socicon-youtube"></span>--}}
{{--            </a>--}}
{{--        </nav>--}}

{{--    </div>--}}
</div>