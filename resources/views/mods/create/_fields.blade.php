{{-- THERE ARE FIELDS FOR THE MODS CREATION FORM --}}

{{--------------------------- NAME (TEXT) -------------------------------------}}
@include ('mods.create.includes._name', ['modification' => $modification])

{{-------------------------- DESCRIPTION (TEXTAREA) ---------------------------}}
@include ('mods.create.includes._description', ['modification' => $modification])

{{-------------------------- PRESENTATION (TEXTAREA) --------------------------}}
@include ('mods.create.includes._presentation', ['modification' => $modification])

{{------------------- MAIN IMAGE (FILE) AND SCREENSHOTS(FILE) -----------------}}
@include ('mods.create.includes._images', ['modification' => $modification])

{{-------------------------- TRAILER VIDEO LINK (TEXT) ------------------------}}
@include ('mods.create.includes._video_link', ['type' => 'trailer', 'modification' => $modification])

{{-------------------------- REVIEW VIDEO LINK (TEXT) -------------------------}}
@include ('mods.create.includes._video_link', ['type' => 'review', 'modification' => $modification])

{{------------- A SELECT BASE GAME VERSION FIELD (DROP DOWN MENU) -------------}}
@include ('mods.create.includes._base_version', ['modification' => $modification])

{{--------------- DOWNLOAD LINKS (DROP DOWN MENU AND TEXT FIELDS) -------------}}
{{-- @include ('mods.create.includes._download_links', ['downloadSources' => $downloadSources, 'modification' => $modification]) --}}

{{------------------------------- TAGS (TEXT) ---------------------------------}}
@include ('mods.create.includes._tags', ['modification' => $modification])

{{------------------------ CUSTOM LINKS (TEXT FIELDS) -------------------------}}
@include ('mods.create.includes._custom_links', ['modification'  => $modification])

{{------------------------ SOCIAL LINKS (TEXT FIELDS) ------------------------}}
@include ('mods.create.includes._social_links', ['modification'  => $modification])


{{----------------------------- A SUBMIT BUTTON -------------------------------}}


<div class="data-form-input-container submit-block">
    <div class="alert alert-danger error-block hide"> {{-- if some necessary field is unfilled --}}
        {{ __('modification.create.submit.not_all') }}
    </div>

    {!! Form::submit(__('Create'),
        [
            'id'                => 'submit-btn-text',
            'class'             => 'btn btn-info btn-lg',
            'style'             => 'width: 50%',
        ])
    !!}
</div>