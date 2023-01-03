{{---------------- EDIT AND DELETE THIS MODIFICATION PAGE ---------------------}}
@if ((Auth::user()->id ?? null) === $modification->author()->id)
    {{-- A LINK TO EDIT FORM  --}}
    {{ link_to_route("mods.edit", __("Edit Modification"), ['mod' => $modification->slug],
        [
            'class' => 'btn btn-lg primary'
        ])
    }}

    {{-- A LINK TO DELETE THIS POST --}}
    {!! Form::open(
        [
            'route' => ['mods.destroy', 'mod' => $modification->slug],
            'method' => 'delete'
    ]) !!}
    {!! Form::submit(__("Delete Modification"), ['class' => 'btn btn-lg primary']) !!}
    {!! Form::close() !!}
@endif