@extends('layouts.theme')

@section('global')
    @include('flash::message')

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

        <h1>{{ __('creation of a new post') }}</h1>
        <div class="col">

            {{----------------------- THE FORM OPENING TAG ------------------------------}}
            {!! Form::open(
                [
                    'route'     => 'posts.store',
                    'class'     => 'form',
                    'id'        => 'form',
                    'enctype'   => "multipart/form-data",
                    'files'     => true,
                ])
            !!}

            {{-------------------------- A SELECT POST TYPE FIELD --------------------}}
            <div class="form-group">
                {!! Form::label(__('select_post_type'), 'Select type of a new post',
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
            @include ("posts.create._create-video-post-fields")

            {{----- OTHER POSTS TYPES FIELD ----}}
            @include ("posts.create._create-usual-post-fields")



            <br>
            <hr>

            {{------------------------------------- TAGS ---------------------------------}}
            <div class="form-group">
                {!! Form::label('tags', __('Tag of the post'),
                    ['class' => 'control-label'])
                !!}
                {!! Form::text('tags', null,
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
                {!! Form::submit(__('Create'),
                    [
                       'class'     => 'btn btn-info btn-lg',
                       'style'     => 'width: 50%',
                    ])
                !!}
            </div>

            {{-- A form closing tag --}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"
            src="{{ \Illuminate\Support\Facades\URL::asset('js/create/create-post.js') }}">
    </script>
@endsection