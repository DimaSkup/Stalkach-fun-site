 <h1>{{ __('a searching form') }}</h1>

    {{-- ATTENTION: THERE IS A STYLE ATTRIBUTE IN DIV DOWN BELOW --}}
    <div class="row" style="background: white">
        <div class="col">

            {{-- THE FORM OPENING TAG --}}
            {!! Form::open(
                [
                    'route'     => 'search',
                    'method'    => 'GET',
                ],
                ['class' => 'form'])
            !!}

            {{-- THE SEARCH LINE --}}
            <div class="search">
                <div class="form-group">
                    {!! Form::label(__('search_line'), null,
                        ['class' => 'control-label'])
                    !!}
                    {!! Form::text('query', null,
                        [
                            'class'         => 'form-control',
                            'placeholder'   => __('News, memes, mods, ...'),
                        ])
                    !!}
                </div>
            </div>

            <div class="popular-tags">
                <div class="form-group">
                    @foreach($tags as $tagData)
                        <a href="{{ route('search', ['tag_id' => $tagData['id']]) }}">
                            {{ $tagData['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- A SUBMIT BUTTON --}}
            <div class="form-group">
                {!! Form::submit(__('SEARCH'),
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


    <hr>
    @include ('.search.results.results-list')

