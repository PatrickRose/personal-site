@extends('layouts.master')

@section('title')
    Create new Gig
@endsection

@section('content')

    {{ Form::open(array('route' => 'gigs.store', 'role' => 'form')) }}
        <div class="form-group">
            {{ Form::label("date", "Date: ") }}
            {{ Form::input("date", "date", null, array("class" => "form-control", "placeholder" => "Date...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("time", "Time: ") }}
            {{ Form::text("time", null, array("class" => "form-control", "placeholder" => "Start time...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("location", "Location: ") }}
            {{ Form::text("location", null, array("class" => "form-control", "placeholder" => "Content...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("about", "About: ") }}
            {{ Form::text("about", null, array("class" => "form-control", "placeholder" => "About...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("cost", "Cost: ") }}
            {{ Form::text("cost", null, array("class" => "form-control", "placeholder" => "Ticket link...")) }}
        </div>
        <div class="form-group">
            {{ Form::label("ticketlink", "Ticket Link: ") }}
            {{ Form::text("ticketlink", null, array("class" => "form-control", "placeholder" => "Ticket link...")) }}
        </div>
    {{ Form::submit("Create Gig", array("class" => "btn btn-primary")) }}

    {{ Form::close() }}

@endsection