@extends('documentation.base')

@section('content')
    Всі моделі розташовані у каталозі <b>app/Models/</b>

    <div>
        <p>
            Деякі моделі можуть мати ТРЕЙТИ (підкаталог <b>Traits</b>)
            та відповідні РЕПОЗИТОРІЇ (підкаталог <b>Repository</b>)
        </p>

        Список моделей:
        <ul>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.file"]) }}">
                    File
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.file-model"]) }}">
                    FileModel
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.mod"]) }}">
                    Mod
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.mod-rating"]) }}">
                    ModRating
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.mod-review"]) }}">
                    ModReview
                </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.post"]) }}">
                    Post
                </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.post-category"]) }}">
                    PostCategory
                </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.tag"]) }}">
                    Tag
                </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.user"]) }}">
                    User
                </a>
            </li>
        </ul>
    </div>
@endsection
