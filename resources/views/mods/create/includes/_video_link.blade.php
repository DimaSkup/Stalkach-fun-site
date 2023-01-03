{{-------------------------- VIDEO LINK (TEXT) -------------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container">
    {!! Form::label(
        'video_link',
        __("modification.create.video_link.label.$type"),
        ['class' => 'control-label'])
    !!}

    {{-- here we place error messages --}}
    <div class="alert alert-danger error-block hide">
        {{ __('modification.create.submit.empty_field') }}
    </div>

    {!! Form::text('video_link',
        $modification->videoLink ?? null,
        [
            'class'         => "form-control input-lg",
            'placeholder'   => __('modification.create.video_link.put_here'),
            'data-form-input' => 'video-link',
        ])
    !!}
</div>