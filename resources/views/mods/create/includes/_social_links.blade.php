{{------------------------ SOCIAL LINKS (TEXT FIELDS) ------------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="social-links" data-links="add_social_links_block">
    {{-- COMMON LABEL --}}
    {!! Form::label(
        'social_links',
        __("modification.create.social_links.label"),
        ['class' => 'control-label'])
    !!}

    {{-- A DROP-DOWN MENU --}}
    <div class="dropdown">
        {{-- a default option --}}
        <div class="dropbtn">{{ __('modification.create.social_links.menu_options.default') }}</div>

        {{-- available menu options --}}
        <div class="dropdown-content" data-links="add_social_links_button">
            @foreach(App\Models\Mod::SOCIAL_LINK_TYPES as $type)
                <p data-option="social_link_{{$type}}">{{ $type }} </p>
            @endforeach
        </div>
    </div>

    <br> {{-- ATTENTION: THERE IS A NEW LINE  --}}


    {{-- THERE ARE "SOCIAL LINKS" INPUT FIELDS --}}
    <div class="input-fields" data-links="add_social_links_input_fields">

        {{-- COMMON ERRORS MESSAGES (when no one field is filled, etc.)--}}
        <div class="alert alert-danger error-block hide">
            {{ __('modification.create.submit.empty_field') }}
        </div>

        {{-- make an INPUT FIELD FOR EACH TYPE of social links --}}
        @foreach(App\Models\Mod::SOCIAL_LINK_TYPES as $type)
            {{-- if we edit modification and have some particular social link we show the related input field value. in another case we hide this field --}}
            <div class="{{ ($modification->socialLinks[$type] ?? false) ? "" : "hide" }}"
                data-type="social_link_{{$type}}">

                {{-- when this particular input field has some incorrect value we show an error about it --}}
                <div class="alert alert-danger error-block hide"></div>

                {{-- a button for hidding this element (input field, label, etc.) --}}
                <button data-action="hide_element">X</button>

                {{-- label --}}
                {!! Form::label(
                    "social_link_".$type,
                    $type,                            # a type (name) of the social link
                    ['class' => 'control-label'])
                !!}

                {{-- input field --}}
                {!! Form::text("social_link_".$type,
                    $modification->socialLinks[$type] ?? null,  # a default value (if we want to edit there will be a current value for such a social link)
                    [
                        'class'         => "form-control input-lg",
                        'placeholder'   => __("modification.create.social_links.put_here")." $type",
                        'data-form-input' => 'social-link',
                    ])
                !!}
            </div>
        @endforeach
    </div>
</div>