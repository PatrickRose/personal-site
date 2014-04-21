@extends('layouts.master')

@section('title')
    {{ $blog->title }}
@stop

@section('content')
    <div class="blog-title">
        <h2>
            {{ ucwords($blog->title) }}
        </h2>
    </div>
    <div class="blog-content">
        {{ Markdown::string($blog->content) }}
    </div>
@stop