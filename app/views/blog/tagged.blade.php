@extends('layouts.master')

@section('title')
    {{ $tag }}
@stop

@section('content')
<div class="col-md-3">
    @include('partials/_tags')
</div>
<div class="col-md-9">
    <div class="page-header">
        <h1>
            Blog Posts marked "{{ ucwords($tag) }}"
        </h1>
    </div>
    @foreach(array_chunk($blogs->all(), 3) as $row)
        <div class="row">
            @foreach($row as $blog)
                <div class="col-md-4">
                    <div class="blog-title">
                        <h2>{{ link_to_route("blog.show", ucwords($blog->title), $blog->slug) }}</h2>
                    </div>
                    <div class="blog-text">
                        {{ Markdown::string($blog->getFirstParagraph()) }}
                    </div>
                    {{ link_to_route("blog.show", "Continue Reading...",
                    $blog->slug, array('class' => 'btn btn-blog btn-block')) }}
                </div>
            @endforeach
        </div>
    @endforeach
{{ $blogs->links() }}
</div>
@stop