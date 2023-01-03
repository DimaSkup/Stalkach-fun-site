{{--------------------------- NAME (TEXT) ------------------------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label('name', __("modification.create.name.label"),
        ['class' => 'control-label'])
    !!}
    {{-- here we place error messages --}}
    <div class="alert alert-danger error-block hide" data-empty-error>
        {{ __('modification.create.submit.empty_field') }}
    </div>
    {!! Form::text('name', request()->input('name', old('name')),
        [
            'class'         => 'form-control input-lg',
            'placeholder'   => __('modification.create.name.put_here'),
            'data-form-input'   => 'name',
        ])
    !!}
</div>