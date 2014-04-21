@extends('layouts.master')

@section('title')
   Blog
@stop

@section('content')
   @foreach($blogs as $blog)
       <div class="blog-title">
           <h2>{{ link_to_route("blog.show", ucwords($blog->title), $blog->slug) }}</h2>
       </div>
       <div class="blog-text">
           {{ $blog->content }}
       </div>
   @endforeach
@stop