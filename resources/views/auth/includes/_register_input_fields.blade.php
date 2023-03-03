{{--
    REGISTER INPUT FIELDS;
    THESE FIELDS ARE ALSO USED IN THE USER EDIT FORM;
--}}

{{--------------- an input name field --------------------}}
<div class="form-group row">
    {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
    <div class="">
        {!! Form::text('name', null,
             [
                 'class'         => 'form-control',
                 'placeholder'   => '',
             ])
        !!}
    </div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

</div>

{{------------------ an input email field -----------------}}
<div class="form-group row">
    {!! Form::label('email', __('E-Mail Address'), ['class' => 'control-label']) !!}

    <div class="">
        {!! Form::email('email', null,
            [
                'class'         => 'form-control',
                'placeholder'   => '',
            ])
        !!}
    </div>

    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

{{----------------- an input password field --------------------}}
<div class="form-group row">
    {!! Form::label('password', __('Password'), ['class' => 'control-label']) !!}

    <div class="">
        {!! Form::password('password',
           [
               'class'         => 'form-control',
               'placeholder'   => '',
           ])
        !!}
    </div>

    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

{{-- an input password-confirm field --}}
<div class="form-group row">
    {!! Form::label('password-confirm',  __('Confirm Password'), ['class' => 'control-label']) !!}

    <div class="">
        {!! Form::password('password_confirmation',
             [
                 'class'         => 'form-control',
                 'placeholder'   => '',
             ])
        !!}
    </div>
    @error('password_confirmation')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>