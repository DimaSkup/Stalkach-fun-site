    {{-- THE NEXT SEVERAL FIELDS ARE FOR THE VIDEO POST TYPE --}}
    {{-- A LINK TO A VIDEO --}}

    <div class="block-post-video {{ ($errors->has('video_link')) ? "" : "hide" }}"
         data-block-type="video">

        <br>
        <hr>

        {{------------------------- A VIDEO LINK FIELD --------------------------------}}
        <div class="form-group">
            {!! Form::label(__('video_link'), __('A link to video'),
               ['class' => 'control-label'])
            !!}

            {!! Form::text('video_link', null,
                [
                    'class'         => 'form-control input-lg',
                    'placeholder'   => 'put a video link here',
                ])
            !!}

            {{-- show errors about a video link--}}
            @error('video_link')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- in case we have a duplicated video link, we show a message about it --}}
            @error('video_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    {{-- END OF THE BLOCK FOR A VIDEO CREATION --}}
