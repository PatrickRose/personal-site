@extends('layouts.master')

@section('title')
    Blog
@stop

@section('content')
    @foreach($blogs->all() as $blog)
        @include('partials/_blog')
    @endforeach
    <div class="center">
        {{ $blogs->links() }}
    </div>
@stop
