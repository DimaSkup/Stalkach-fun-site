{{-- THE NEXT SEVERAL FIELDS ARE FOR THE OTHER POST TYPES --}}

@php
    if (isset($errors->getBag('default')->all()[0]) && ($errors->getBag('default')->all()[0]  === "token_error"))
    {
        $errors->getBag('default')->add('image', "The file which you have passed is too large");
    }

@endphp

{{-- if there is some errors about data we don't hide the fields and show errors--}}
<div class="block-post-usual {{ ($isUsualPost) ? "" : "hide" }}"
     data-block-type="other">
    <br>
    <hr>

    {{-------------------------------------- FILE ------------------------------------}}
    <div class="post-field">
        {!! Form::label(__('post_image'), __('A post image'),
            ['class' => 'control-label'])
        !!}

        {!! Form::file('image')
        !!}

        @error('image')
            @foreach ($errors->get('image') as $errorMessage)
                <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endforeach
        @enderror
    </div>

    {{-------------------------------------- TITLE ------------------------------------}}
    <div class="post-field">
        {!! Form::label(__('title'), __('A post title'),
            ['class' => 'control-label'])
        !!}

        {!! Form::text('title', null,
            [
                'class'         => 'form-control input-lg',
                'placeholder'   => __('put a title here'),
            ])
        !!}

        @error('title')
            @foreach ($errors->get('title') as $errorMessage)
                <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endforeach
        @enderror
    </div>

    {{-------------------------------- TEXT --------------------------------------}}
    <div class="post-field">
        {!! Form::label(__('text'), ('A post text'),
            ['class' => 'control-label'])
        !!}

        {!! Form::textarea('text', null,
            [
                'class'         => 'form-control input-lg',
                'placeholder'   => __('put a text here')
            ])
        !!}

        @error('text')
            @foreach ($errors->get('text') as $errorMessage)
                <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endforeach
        @enderror
    </div>

    {{----------------------------- DESCRIPTION -----------------------------------}}
    <div class="post-field">
        {!! Form::label(__('description'), ('A post description'),
            ['class' => 'control-label'])
        !!}

        {!! Form::textarea('description', null,
            [
                'class'         => 'form-control input-lg',
                'placeholder'   => __('put a description here')
            ])
        !!}

        @error('description')
            @foreach ($errors->get('description') as $errorMessage)
                <div class="alert alert-danger">{{ $errorMessage }}</div>
            @endforeach
        @enderror
    </div>


</div>

{{-- END OF THE BLOCK FOR THE OTHER POST TYPES CREATION --}}