@extends('layouts.master')

@section('title')
    Create song
@stop

@section('content')
    {{ Form::open(array('route' => 'songs.store', 'role' => 'form')) }}
    <div class="form-group">
        {{ Form::label("title", "Title: ") }}
        {{ Form::text("title", null, array("placeholder" => "Title...")) }}
    </div>
    <div class="form-group">
        {{ Form::label("composer", "Composer: ") }}
        {{ Form::text("composer", null, array("placeholder" => "Composer...")) }}
    </div>
    <div class="form-group">
        {{ Form::label("lyrics", "lyrics: ") }}
        {{ Form::textarea("lyrics", null, array("class" => "form-control", "placeholder" => "Lyrics...")) }}
    </div>
    <div class="form-group">
        {{ Form::label("info", "Information: ") }}
        {{ Form::textarea("info", null, array("class" => "form-control", "placeholder" => "Information...")) }}
    </div>
    <div class="form-group">
        {{ Form::label("recorded", "Recorded on: ") }}
        {{ Form::select("recorded", $options, null, array("class" => "form-control")) }}
    </div>
    <div class="form-group">
        {{ Form::label("video", "Youtube link: ") }}
        {{ Form::text("video", null, array("class" => "form-control", "placeholder" => "Youtube video id...")) }}
    </div>
    {{ Form::submit("Create Song", array("class" => "btn btn-primary")) }}

    {{ Form::close() }}
@stop
