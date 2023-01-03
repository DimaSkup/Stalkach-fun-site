@extends('layouts.theme')

@section('content')
    <section id="post-video">
        @include('posts.show._navigation')
        <div class="ratio video-frame">
            <iframe
                    src="{{ $post->videoUrl }}"
                    title="YouTube video"
                    allow="autoplay; fullscreen"
            ></iframe>
        </div>
        <div class="post-body">
            <div class="post-info">
                @include('posts.show._header-min')
                <div class="post-content">
                    {!! $post->text !!}
                </div>
            </div>

            @include('posts.show._feedback-buttons')

            <div class="post-sidebar">
                @include('posts.show._tags', ['post' => $post])
            </div>
        </div>
    </section>
    @include('posts.show._recommendations', ['posts' => $relatedPosts])
    @include('sections.newsletter')
@endsection