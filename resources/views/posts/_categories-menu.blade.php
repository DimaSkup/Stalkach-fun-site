<div class="category-menu">
    @foreach($categories as $category)
        <a href="{{ $category->url }}">{{ $category->name }}</a>
    @endforeach
</div>