@extends('layouts.master')

@section('title')
   Blog
@stop

@section('content')
   @foreach(array_chunk($blogs->all(), 3) as $row)
       <div class="row">
           @foreach($row as $blog)
               @include('partials/_blog')
           @endforeach
       </div>
   @endforeach

   {{ $blogs->links() }}
@stop