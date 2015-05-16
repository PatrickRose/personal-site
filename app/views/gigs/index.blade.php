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
            <th>
                Cost
            </th>
            <th>
                Ticket Link
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
                <td>
                    {{ $gig->cost }}
                </td>
                <td>
                    <a href="{{ $gig->ticketlink }}">
                        Ticket Link
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($gigs->isEmpty())
        <div class="alert alert-info">
            No bookings, check back soon!
        </div>
    @endif

    {{ $gigs->links() }}
</div>
@stop