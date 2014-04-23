@extends('layouts.master')

@section('title')
    Edit Post
@stop

@section('content')

    {{ Form::model($blog,
                   array('route' => array('blog.update',
                                          $blog->slug),
                         'method' => 'patch')) }}
         <div class="form-group">
             {{ Form::label("title", "Title: ") }}
             {{ Form::text("title", null, array("placeholder" => "Title...")) }}
         </div>
         <div class="form-group">
             {{ Form::label("content", "Content: ") }}
             {{ Form::textarea("content", null, array("class" => "form-control", "placeholder" => "Content...")) }}
         </div>

         {{ Form::submit("Edit Post", array("class" => "btn btn-primary")) }}

    {{ Form::close() }}
@stop