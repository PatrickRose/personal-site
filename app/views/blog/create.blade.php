@extends('layouts.master')

@section('title')
    Create blog post
@stop

@section('content')
    {{ Form::open(array('route' => 'blog.store', 'role' => 'form')) }}
        <div class="form-group">
            {{ Form::label("title", "Title: ") }}
            {{ Form::text("title", null, array("placeholder" => "Title...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("content", "Content: ") }}
            {{ Form::textarea("content", null, array("class" => "form-control", "placeholder" => "Content...")) }}
        </div>

        {{ Form::submit("Create Post", array("class" => "btn btn-primary")) }}

{{ Form::close() }}
@stop
