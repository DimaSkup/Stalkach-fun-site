{{------------------------ PRESENTATION (TEXTAREA) -----------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label('presentation', __("modification.create.presentation.label"),
        ['class' => 'control-label'])
    !!}

    {{-- here we place error messages --}}
    <div class="alert alert-danger error-block hide">
        {{ __('modification.create.submit.empty_field') }}
    </div>

    {!! Form::textarea(
        'description',
        request()->input('presentation', old('presentation')),
        [
            'class'         => "form-control input-lg",
            'placeholder'   => __('modification.create.presentation.put_here'),
            'data-form-input'   => 'description',
        ])
    !!}
</div>