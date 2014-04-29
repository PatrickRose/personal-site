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
        <tr>
            <td>
                1st May
            </td>
            <td>
                8:30pm
            </td>
            <td>
                Princess Royal
            </td>
            <td>
                Crookes Folk Club guest night
            </td>
        </tr>
        <tr>
            <td>
                3rd May
            </td>
            <td>
                5:00pm
            </td>
            <td>
                Sheffield University
            </td>
            <td>
                Sheffield University Beer Festival
            </td>
        </tr>
        <tr>
            <td>
                3rd May
            </td>
            <td>
                6:30pm
            </td>
            <td>
                Sheffield University
            </td>
            <td>
                Sheffield University Beer Festival (as part of CeilidhSoc scratch band)
            </td>
        </tr>
        <tr>
            <td>
                5th July
            </td>
            <td>
                TBC
            </td>
            <td>
                Wincobank Hill
            </td>
            <td>
                Tour De France community event
            </td>
        </tr>
        <tr>
            <td>
                12th July
            </td>
            <td>
                PRIVATE
            </td>
            <td>
                Private Party
            </td>
            <td>
                Calling with Whiskey for Six
            </td>
        </tr>
        <tr>
            <td>
                19th July
            </td>
            <td>
                PRIVATE
            </td>
            <td>
                Private Party
            </td>
            <td>
                Calling gig at wedding party
            </td>
        </tr>
        </tbody>
    </table>
</div>
@stop