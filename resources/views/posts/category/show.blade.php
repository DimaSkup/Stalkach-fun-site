@extends('layouts.theme')

@section('content')
    @include('posts._categories-menu')
    <section class="category-header" style="background-image: url('{{ $category->background_image }}')">
        <div class="bg-text">{{ $category->name }}</div>
        <h1>{{ $category->name }} posts</h1>
        <p>{{ $category->description }}</p>
        <div class="buttons-wrapper">
            <button class="btn secondary">@lang('ui.category.post_new')</button>
        </div>
    </section>

    @include('posts.category._pinned-sections', ['category' => $category, 'posts' => $pinnedPosts])

    <section class="posts-list content-container gradient">
        <div class="posts-filers">
            <div class="left-side">
                <div class="categories-container">
                    <label>
                        <input type="radio" class="category-item" name="content" value="all">
                        <span>@lang('ui.category.posts_list.all')</span>
                    </label>
                    <label>
                        <input type="radio" class="category-item" name="content" value="post">
                        <span>@lang('ui.category.posts_list.articles')</span>
                    </label>
                    <label>
                        <input type="radio" class="category-item" name="content" value="mod">
                        <span>@lang('ui.category.posts_list.videos')</span>
                    </label>
                    <label>
                        <input type="radio" class="category-item" name="content" value="media">
                        <span>@lang('ui.category.posts_list.gallery')</span>
                    </label>
                </div>
            </div>
            <div class="right-side">
                <div class="s-group">
                    <label class="s-control" for="city">@lang('ui.filter_label')</label>
                    <select class="s-control" name="city" id="city">
                        <option>@lang('ui.filter_option_related')</option>
                        <option>@lang('ui.filter_option_popular')</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="posts-grid">
            @foreach($posts as $post)
                @include('posts.blocks._post-block', ['post' => $post])
            @endforeach
        </div>
        <div class="loadmore-wrapper">
            <button class="btn secondary-outline btn-lg loading">@lang('ui.loading_button')</button>
        </div>
    </section>
@endsection