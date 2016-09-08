@extends('layouts.master')

@section('title')
    {{ $song->title }}
@stop

@section('content')

    <div class="row topspace">
        <aside class="col-md-4 sidebar sidebar-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Song Information</h4>
                </div>
                <div class="song-information">                    
                    {!! $song->present()->getInfo() !!}
                </div>
            </div>
        </aside>
        <article class="col-md-8 maincontent">
            <header class="page-header">
                <h2 class="page-title song-title">
                    {{ ucwords($song->title) }}
                </h2>
                <p class="song-composer">
                    {{ $song->composer }}
                </p>
                {!! $song->present()->showRecorded() !!}
            </header>
            <div class="song-lyrics">
                {!! $song->present()->getLyrics() !!} 
            </div>
            {!! $song->present()->getVideo() !!}
        </article>
    </div>
            
@stop
