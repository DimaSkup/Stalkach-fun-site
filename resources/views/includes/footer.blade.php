<footer class="content-container">
    <div class="pre-footer">
        <div class="pre-footer__description-content">
            <div class="pre-footer__logo">
                @include('includes.logo')
            </div>
            <div class="pre-footer__description">
                @lang('ui.footer.description')
            </div>
        </div>
        <div class="pre-footer__content">
            <div class="pre-footer__title">@lang('ui.footer.contacts')</div>
            <div class="pre-footer__wrapper">
                <a href="{{ route('contacts') }}">
                    <span>Administrator</span>
                </a>
                <a href="{{ route('contacts').'#advertisement' }}">
                    <span>Advertisement</span>
                </a>
                <a href="{{ route('contacts').'#jobs' }}">
                    <span>Jobs</span>
                </a>
                <a href="{{ route('contacts').'#cooperation' }}">
                    <span>Cooperation</span>
                </a>
            </div>
        </div>
        <div class="pre-footer__content">
            <div class="pre-footer__title">@lang('ui.footer.legal')</div>
            <div class="pre-footer__wrapper">
                <a href="{{ route('cookies') }}">
                    <span>Cookies policy</span>
                </a>
                <a href="{{ route('privacy')}}">
                    <span>Privacy policy</span>
                </a>
                <a href="{{ route('terms') }}">
                    <span>Terms of use</span>
                </a>
            </div>
        </div>
        <div class="pre-footer__content">
            <div class="pre-footer__title">@lang('ui.footer.social')</div>
            <div class="pre-footer__wrapper">
                <a href="#">
                    <span>Instagram</span>
                </a>
                <a href="#">
                    <span>Telegram</span>
                </a>
                <a href="#">
                    <span>Youtube</span>
                </a>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div>© 2022 - @lang('ui.footer.bottom')</div>
        <div></div>
    </div>
</footer>