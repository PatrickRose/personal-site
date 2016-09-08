@extends('layouts.master')

@section('title')
    Song book
@stop

@section('content')
    <div class="page-header">
        <h1 class="text-center">Songs</h1>
    </div>
    <div class="panel song-book-panel">
        <div class="song-book-list">
            @foreach($songs as $song)
                <a href="{{ route('songs.show', $song->slug) }}" class="song"><span class="song-title">{{ $song->title }}</span><br/><span class="song-composer">{{ $song->composer }}</span></a>
            @endforeach
        </div>
    </div>
@stop
