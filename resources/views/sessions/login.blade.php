@extends('layouts.master')

@section('title')
    Login
@stop

@section('content')
    <div class="form">
        {!! Form::open(array("role" => "form", "route" => "sessions.store")) !!}
            <h2>
                Please sign in
            </h2>
            <div class="form-group">
                {!! Form::label("username", "Username: ") !!}
                {!! Form::text("username", null, array('placeholder' => "Username...")) !!}
            </div>
            <div class="form-group">
                {!! Form::label("password", "Password: ") !!}
                {!! Form::password("password", array('placeholder' => "Password...")) !!}
            </div>
            {!! Form::submit("Log in", array("class" => "btn btn-primary")) !!}
        {!! Form::close() !!}
    </div>
@stop
