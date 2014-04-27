@extends('layouts.master')

@section('title')
    {{ $tag }}
@stop

@section('content')
<div class="col-md-3">
    @include('partials/_tags')
</div>
<div class="col-md-9">
    <div class="page-header">
        <h1>
            Blog Posts marked "{{ ucwords($tag) }}"
        </h1>
    </div>
    @foreach(array_chunk($blogs->all(), 3) as $row)
        <div class="row">
            @foreach($row as $blog)
                @include('partials/_blog')
            @endforeach
        </div>
    @endforeach
{{ $blogs->links() }}
</div>
@stop