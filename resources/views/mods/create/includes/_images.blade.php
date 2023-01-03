{{-------------------------- MAIN IMAGE (FILE) ------------------------}}
<br> {{-- ATTENTION: THERE IS A NEW LINE  --}}

<div class="data-form-input-container" data-form-block="images-fields">
    <div class="data-form-input-container">
        {!! Form::label(
            'main_image',
            __('modification.create.images.main_image.label'),
            ['class' => 'control-label'])
        !!}

        {{-- here we place error messages --}}
        <div class="alert alert-danger error-block hide">
            {{ __('modification.create.submit.empty_field') }}
        </div>

        {!! Form::file('main_image',
            [
                'id'     => 'main-image',
                'accept' => 'image/*,image/jpeg',
                'data-form-input' => 'main-image',
            ])
        !!}

        {{-- if we edit the modification we have a main image so show it --}}
        @if ($modification)
            <div class="">
                {!! Form::label(
                    'main_image',
                    __('modification.edit.images.main_image'),
                    ['class' => 'control-label'])
                !!}

                <div class="">
                    <img src="{{ asset($modification->main_image) }}" width="320" alt="main_image">
                </div>
            </div>
        @endif


    </div>


    {{-------------------------- SCREENSHOTS (FILE) -------------------------}}
    <div class="data-form-input-container">
        {!! Form::label(
            'screenshots',
            __('modification.create.images.screenshots.label'),
            ['class' => 'control-label'])
        !!}

        {{-- here we place error messages --}}
        <div class="alert alert-danger error-block hide">
            {{ __('modification.create.submit.empty_field') }}
        </div>

        {!! Form::file('screenshots[]',
            [
                'multiple' => true,
                'accept' => 'image/*,image/jpeg',
                'data-form-input' => 'screenshots',
            ])
        !!}
    </div>

    {{-- if we edit the modification we have a main image so show it --}}
    @if ($modification)
        <div class="">
            {!! Form::label(
                'main_image',
                __('modification.edit.images.screenshots'),
                ['class' => 'control-label'])
            !!}
            <div class="">
                @foreach ($modification->screenshotsList as $screenshot)
                    <img src="{{ asset($screenshot) }}" width="320"  alt="screenshots">
                @endforeach
            </div>
        </div>
    @endif


    {{---------- COMMON ERROR MESSAGES which concern both images fields ------------}}
    <div class="alert alert-danger error-block hide" data-common-errors="images">
        {{ __('modification.create.images.both_common_error') }}
    </div>
</div>