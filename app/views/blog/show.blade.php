@extends('layouts.master')

@section('title')
    {{ $blog->title }}
@stop

@section('content')
    <div class="blog-title">
        <h2>
            {{ $blog->title }}
        </h2>
    </div>
    <div class="blog-content">
        {{ $blog->content }}
    </div>
@stop