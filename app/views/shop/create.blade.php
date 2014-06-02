@extends('layouts.master')

@section('title')
    Create new Item
@stop

@section('content')
{{ Form::open(array('route' => 'shop.store', 'role' => 'form')) }}

    <!-- title -->
    <div class='form-group'>
        {{ Form::label('title', 'Title: ') }}
        {{ Form::text('title') }}
    </div>

    <!-- description -->
    <div class='form-group'>
        {{ Form::label('description', 'Description: ') }}
        {{ Form::textarea('description') }}
    </div>

    <!-- price -->
    <div class='form-group'>
        {{ Form::label('price', 'Price: ') }}
        {{ Form::text('price') }}
    </div>

    {{ Form::submit('Create item') }}

{{ Form::close() }}

@stop