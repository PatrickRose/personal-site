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
                    <h4>Tagged with</h4>
                </div>
                <ul class="blog-tags">
                    @foreach($blog->tags as $tag)
                        <li class="blog-tag">
                            {{ $tag->tag }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Other Posts...</h4>
                </div>
                @if(Auth::user())
                    <div class="panel-body">
                        {{ link_to_route('blog.edit', "Edit Post", $blog->slug, array('class'=>'btn btn-blog btn-block')) }}
                    </div>
                @endif
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