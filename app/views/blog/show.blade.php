@extends('layouts.master')

@section('title')
    {{ $blog->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="blog-title">
                <h2>
                    {{ ucwords($blog->title) }}
                </h2>
            </div>
            <div class="blog-content">
                {{ Markdown::string($blog->content) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Other Posts...</h4>
                </div>
                <ul class="list-group">
                    @foreach($blogs as $blog)
                        <li class="list-group-item">
                            {{ link_to_route('blog.show', ucwords($blog->title), $blog->slug) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop