{{----------------------------- TAGS (TEXT) -----------------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label('tags', __('modification.create.tags.label'),
        ['class' => 'control-label'])
    !!}
    {!! Form::text('tags',
        $modification->tagsNamesString ?? null,
        [
            'class'         => 'form-control input-lg',
            'placeholder'   => __('modification.create.tags.put_here'),
            'data-form-input' => 'tags',
        ])
    !!}
</div>