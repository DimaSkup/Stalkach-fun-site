<div>
    <h1></h1>LIST:
    <ul>
        @foreach ($categoriesList as $categoryObj)
            <li>{{ $categoryObj->name }}</li>
        @endforeach
    </ul>

    <br><br><br>


    SINGLE CATEGORY:
    <h2>Name:</h2>
    {{ $postCategory->name }}
    <br>

    <h2>Description</h2>
    {{ $postCategory->description }}
    <br>

    <h2>BACKGROUND IMAGE:</h2>
        <img src="{{ $postCategory->backgroundImage }}" alt="category_back_image">
    <br>

    <h2>Related posts:</h2>
    <ul>
        @foreach($postCategory->posts as $post)
            <li>
                <a href="{{ $post->url }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>

</div>