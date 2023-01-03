{{------ MODEL PROPERTIES (CONSTANTS, RELATIONS, MUTATORS, ACCESSORS) -----}}
<div>
    <div class="drop-down-list">
        <h2 class="title">Опис властивостей самої моделі Mod
            <br>
            (трейтів, констант, відношень, мутаторів, аксессорів):
        </h2>
        <div class="drop-down-list-content hide">
            <div class="description">
                Опис йде в тому порядку, в якому й розташовані самі властивості у php-файлі
                цієї моделі.
            </div>
            <div>

                {{-- TRAITS --}}
                @include('documentation.show.models.includes._mod_traits')

                {{-- CONSTANTS --}}
                @include('documentation.show.models.includes._mod_constants')

                {{-- RELATIONS --}}
                @include('documentation.show.models.includes._mod_relations')

                {{-- ACCESSORS --}}
                @include('documentation.show.models.includes._mod_accessors')

                {{-- MUTATORS --}}
                @include('documentation.show.models.includes._mod_mutators')

            </div>
    </div>
</div>