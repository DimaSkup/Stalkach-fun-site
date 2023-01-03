{{------------------ A SELECT BASE VERSION FIELD (DROP DOWN MENU) -----------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label(__('select_game_type'),
        __('modification.create.game_version.label'),
        ['class' => 'control-label'])
    !!}

    {{-- a drop-down menu --}}
    <div class="dropdown"
         data-select="game"
         data-form-input="game">
        {{-- a default option --}}
        <div class="dropbtn" data-option-cur="{{$modification->game ?? null}}" data-option="default">
            {{ $modification->game ??  __('modification.create.game_version.menu_options.default') }}
        </div>
        {{-- available menu options --}}
        <div class="dropdown-content">
            <p data-option="soc">{{ __('modification.create.game_version.menu_options.soc') }}</p>
            <p data-option="cs">{{  __('modification.create.game_version.menu_options.cs') }}</p>
            <p data-option="cop">{{ __('modification.create.game_version.menu_options.cop') }}</p>
            <p data-option="hoc">{{ __('modification.create.game_version.menu_options.hoc') }}</p>
        </div>
    </div>

    {{-- here we place error messages --}}
    <div class="alert alert-danger error-block hide">
        {{ __('modification.create.submit.empty_field') }}
    </div>
</div>