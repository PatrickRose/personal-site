@extends('layouts.master')

@section('title')
   Blog
@stop

@section('content')
  <div class="row topspace">
    <div class="col-sm-8 col-sm-offset-2">
															
      @foreach($blogs->all() as $blog)
        @include('partials/_blog')
      @endforeach
      <center class="text-align">
	{{ $blogs->links() }}
      </p>
@stop
