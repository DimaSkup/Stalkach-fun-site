@extends('layouts.fullscreen')

@section('content')
    @include('flash::message')

    {{-- back to the current post page --}}
    {{ link_to_route('posts.show', __("Back to post"), ['post' => $post->slug],
        [
            'class' => "btn",
        ])
    }}

    @php
       // dd(get_defined_vars());

        if (isset($errors->getBag('default')->all()[0]) && ($errors->getBag('default')->all()[0]  === "token_error"))
        {
            $errors->getBag('default')->add('image', "The file which you have passed is too large");
        }
    @endphp

    {{-- AN OUTPUT OF ERROR MESSAGES --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ATTENTION: THERE IS A STYLE ATTRIBUTE IN THE DIV DOWN BELOW --}}
    <div class="row" style="background: white">

        <h1>{{ __('updating of the post') }}</h1>
        <div class="col">

            {{----------------------- THE FORM OPENING TAG ------------------------------}}
            {!! Form::model($post,
                [
                    'method'    => 'put',
                    'route'     => ['posts.update', $post->slug],
                    'class'     => 'form',
                    'id'        => 'form',
                    'enctype'   => "multipart/form-data",
                    'files'     => true,
                ])
            !!}

            {{-------------------------- A SELECT POST TYPE FIELD --------------------}}
            <div class="form-group">
                {!! Form::label(__('select_post_type'), 'Select type of the post',
                    ['class' => 'control-label'])
                !!}
                {!! Form::select('type',
                    [
                        'important'     => __('Important post'),
                        'popular'       => __('Popular post'),
                        'video'         => __('Video post'),
                        'best'          => __('Best post'),
                    ],
                    null,
                    [
                        'class'         => 'form-control type-selector-list input-lg',
                        'placeholder'   => __('type_of_post'),
                        'data-select'   => 'type',
                    ])
                !!}

                @error('type')
                    @foreach ($errors->get('type') as $errorMessage)
                        <div class="alert alert-danger">{{ $errorMessage }}</div>
                    @endforeach
                @enderror
            </div>

            {{--------------------- A SELECT POST CATEGORY FIELD --------------------}}
            <div class="form-group">
                {!! Form::label(__('select_post_category'), 'Select category of a new post',
                    ['class' => 'control-label'])
                !!}
                {!! Form::select('category',
                    [

                        'inside'            => __('Inside'),
                        'modding'           => __('Modding'),
                        'community'         => __('Community'),
                        'rumors'            => __('Rumors'),
                        'from_developers'   => __('From developers'),
                        'other'             => __('Other post'),
                    ],
                    null,
                    [
                        'class'         => 'form-control input-lg',
                        'placeholder'   => __('category_of_post'),
                        'data-select'   => 'category',
                    ])
                !!}

                @error('category')
                    @foreach ($errors->get('category') as $errorMessage)
                        <div class="alert alert-danger">{{ $errorMessage }}</div>
                    @endforeach
                @enderror
            </div>


            {{---------------------------- INCLUDED TEMPLATES---------------------------}}

            {{------- VIDEO POST FIELDS -------}}
            @include ("posts.edit._edit-video-post-fields")

            {{----- OTHER POSTS TYPES FIELD ----}}
            @include ("posts.edit._edit-usual-post-fields")


            <br>
            <hr>

            {{------------------------------------- TAGS ---------------------------------}}
            <div class="form-group">
                {!! Form::label('tags', __('Tag of the post'),
                    ['class' => 'control-label'])
                !!}
                {!! Form::text('tags', $post->getTagsNamesString(),
                    [
                        'class'         => 'form-control input-lg',
                        'placeholder'   => __('put post tags here'),
                    ])
                !!}
            </div>

            <br>
            <hr>

            {{--------------------------- IS IT A FEATURE POST? --------------------------}}
            <div class="form-group">
                {!! Form::label(__('is_feature_post'), __('Is it a feature post')."?",
                    ['class' => 'control-label'])
                !!}
                {!! Form::checkbox('is_feature_post', false)
                !!}
            </div>


            {{----------------------------- A SUBMIT BUTTON -------------------------------}}
            <div class="form-group">
                {!! Form::submit(__('Update'),
                    [
                       'class'     => 'btn btn-warning btn-lg',
                       'style'     => 'width: 50%; color: black',
                    ])
                !!}
            </div>

            {{-- A form closing tag --}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection