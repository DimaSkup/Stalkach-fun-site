{{--------------- DOWNLOAD LINKS (DROP DOWN MENU AND TEXT) --------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div data-download="add_source">
    {!! Form::label(
        'download_links',
        __('modification.create.download_links.label'),
        ['class' => 'control-label'])
    !!}

    {{-- A DROP-DOWN MENU --}}
    <div class="dropdown">
        {{-- a default option --}}
        <div class="dropbtn">{{ __('modification.create.download_links.menu_options.default') }}</div>

        {{-- available menu options --}}
        <div class="dropdown-content" data-download="download_links">
            @foreach(App\Models\Mod::DOWNLOAD_SOURCES as $sourceKey => $source)
                <p data-option="{{$source}}">
                    {{ __("modification.create.download_links.menu_options.".$sourceKey) }}
                </p>
            @endforeach
        </div>
    </div>

    <br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

    {{-- THERE ARE "DOWNLOAD LINKS" INPUT FIELDS --}}
    <div class="data-form-input-container download_links_fields" data-download="inputs">

        {{-- COMMON ERRORS MESSAGES (when no one field is filled, etc.) --}}
        <div class="alert alert-danger error-block hide">
            {{ __('You need to fill in at least one download link') }}
        </div>

        {{-- make an INPUT FIELD FOR EACH TYPE of download sources --}}
        @foreach(App\Models\Mod::DOWNLOAD_SOURCES_TRANS as $sourceKey => $sourceTrans)
            {{-- if we edit modification and have some particular download source  we show the related input field in another case we hide this field--}}
            <div class="{{ ($modification->downloadLinks[$source] ?? false) ? "" : "hide" }}" data-type="{{$source}}">

                {{-- when this particular input field has some incorrect value we show an error about it --}}
                <div class="alert alert-danger error-block hide"></div>

                {{-- a button for hidding this element (input field, label, etc.) --}}
                <button data-action="hide_element">X</button>

                {{-- label --}}
                {!! Form::label(
                    $source,
                    __("modification.create.download_links.menu_options.$sourceKey"),                            # a type (name) of the download source
                    ['class' => 'control-label'])
                !!}

                {{-- input field --}}
                {!! Form::text($source,                                  # name of the field
                    $modification->downloadLinksArray[$source] ?? null,  # a default value (if we want to edit there will be a current value for such a download source)
                    [
                        'class'         => "download-link",
                        'placeholder'   => __("modification.create.download_links.put_here", ['source' => App\Models\Mod::DOWNLOAD_SOURCES_TRANS['']]) . " " . __("modification.create.download_links.menu_options.$sourceKey"),
                        'data-form-input' => $source,
                    ])
                !!}
            </div>

        @endforeach
    </div>
</div>



