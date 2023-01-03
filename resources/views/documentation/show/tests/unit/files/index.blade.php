@extends('documentation.base')

@section('content')
    <h1>Unit-тести: Files</h1>

    Список файлів:
    <ul>
        {{--- FileManagerTest ---}}
        <li>
            <a href="{{ route('documentation.show', ['path' => "$path.file-manager-test"]) }}">
                <span class="file-name">FileManagerTest</span>
            </a>
            -- тестування функціоналу роботи з файловою системою
        </li>

        {{--- ImageCheckerTest ---}}
        <li>
            <a href="{{ route('documentation.show', ['path' => "$path.image-checker-test"]) }}">
                <span class="file-name">ImageCheckerTest</span>
            </a>
            -- тестування валідатора зображень
        </li>

        {{--- ImageEditorTest ---}}
        <li>
            <a href="{{ route('documentation.show', ['path' => "$path.image-editor-test"]) }}">
                <span class="file-name">ImageEditorTest</span>
            </a>
            -- тестування редактора зображень
        </li>

        {{--- ImageUploaderTest ---}}
        <li>
            <a href="{{ route('documentation.show', ['path' => "$path.image-uploader-test"]) }}">
                <span class="file-name">ImageUploaderTest</span>
            </a>
            -- тестування завантажувача зображень
        </li>
    </ul>
@endsection