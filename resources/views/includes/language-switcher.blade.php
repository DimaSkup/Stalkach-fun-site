<button
        class="btn btn-icon"
        type="button"
        id="languageSwitcher"
        data-mdb-toggle="dropdown"
        aria-expanded="false"
>
    <span class="material-icons">language</span>
</button>

<ul class="dropdown-menu" aria-labelledby="languageSwitcher">
    @foreach ($availableLocales as $availableLocale => $localeName)
        <li>
            <a class="dropdown-item {{ $availableLocale === $currentLocale ? 'active' : '' }}"
               href="{{ route('language', ['locale' => $availableLocale]) }}">
                {{ $localeName }}
            </a>
        </li>
    @endforeach
</ul>