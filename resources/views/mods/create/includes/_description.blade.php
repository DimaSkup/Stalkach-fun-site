{{------------------------ DESCRIPTION (TEXTAREA) -----------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label('description', __("modification.create.description.label"),
        ['class' => 'control-label'])
    !!}

    {{-- here we place error messages --}}
    <div class="alert alert-danger error-block hide">
        {{ __('modification.create.submit.empty_field') }}
    </div>

    {!! Form::textarea(
        'description',
        request()->input('description', old('description')),
        [
            'class'         => "form-control input-lg",
            'placeholder'   => __('modification.create.description.put_here'),
            'data-form-input'   => 'description',
        ])
    !!}
</div>