@extends('layouts.theme')

@section('content')
    <div class="content-container">
        <section id="media-browse">
            <div class="header">
                <div class="left-side">
                    <h1>Media</h1>
                </div>

                <div class="right-side">
                    <button class="btn btn-with-icon">
                        <span class="material-icons">upload</span>
                        <span class="text">Upload</span>
                    </button>
                </div>
            </div>

            <form class="filters" method="GET" name="browse-mods">
                <div class="left-side baseline">
                    <div class="categories-container">
                        <label>
                            <input type="radio" class="category-item" name="content" value="all">
                            <span>All</span>
                        </label>
                        <label>
                            <input type="radio" class="category-item" name="content" value="images">
                            <span>Images</span>
                        </label>
                        <label>
                            <input type="radio" class="category-item" name="content" value="videos">
                            <span>Videos</span>
                        </label>
                        <label>
                            <input type="radio" class="category-item" name="content" value="audio">
                            <span>Audio</span>
                        </label>
                        <label>
                            <input type="radio" class="category-item" name="content" value="files">
                            <span>Files</span>
                        </label>
                        <label>
                            <input type="radio" class="category-item" name="content" value="other">
                            <span>Other</span>
                        </label>
                    </div>
                </div>
                <div class="right-side">
                    <div class="s-group s-search ">
                        <input class="s-control"
                               type="search"
                               name="search-mod"
                               id="search-mod"
                               placeholder="Search"
                        >
                    </div>
                    <div class="s-group">
                        <label class="s-radio-block">
                            <input class="s-control"
                                   type="radio"
                                   name="view"
                                   id="grid"
                                   value="grid"
                                   checked
                            >
                            <div class="box" data-mdb-toggle="tooltip" title="Grid view">
                                <span class="material-icons">grid_view</span>
                            </div>
                        </label>
                        <label class="s-radio-block">
                            <input class="s-control"
                                   type="radio"
                                   name="view"
                                   id="list"
                                   value="list"
                            >
                            <div class="box" data-mdb-toggle="tooltip" title="List view">
                                <span class="material-icons">view_list</span>
                            </div>
                        </label>
                    </div>
                    <div class="s-mini-loader"></div>
                </div>
            </form>
            <div class="grid">
                @foreach(array_fill(1, 10, 'ff') as $key => $value)
                    <div class="media-item">
                        <a class="thumb-img" data-fslightbox="gallery" href="https://picsum.photos/1240/600?random={{ $key }}">
                            <img src="https://picsum.photos/1240/600?random={{ $key }}">
                        </a>
                        <div class="metadata">
                            <div class="first-line">
                                <a class="title" href="#">
                                    super-poster.jpg
                                </a>
                                <div class="size">
                                    34.22kb
                                </div>
                            </div>
                            <div class="second-line">
                                @include('includes.user-modal', ['user' => \App\Models\User::find(1), 'isMin' => true])
                                <div class="buttons-wrapper">
                                    <button class="likes">
                                        <span>33</span>
                                        <span class="material-icons">favorite_border</span>
                                    </button>
                                    <button class="downloads">
                                        <span>125</span>
                                        <span class="material-icons">download</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection