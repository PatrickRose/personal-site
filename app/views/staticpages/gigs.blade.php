@extends('layouts.master')

@section('title')
    Upcoming Gigs
@stop

@section('content')
<div class="page-header">
    <h1>
        Upcoming Gigs
    </h1>
</div>

<div class="table-responsive">
    <table class="table gig-table">
        <thead>
        <tr>
            <th>
                Date
            </th>
            <th>
                Time
            </th>
            <th>
                Location
            </th>
            <th>
                About
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($gigs as $gig)
            <tr>
                <td>
                    {{ $gig->date }}
                </td>
                <td>
                    {{ $gig->time }}
                </td>
                <td>
                    {{ $gig->location }}
                </td>
                <td>
                    {{ $gig->about }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop