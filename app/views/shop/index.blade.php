@extends('layouts.master')

@section('title')
Shop
@stop

@section('content')
<div class="item-grid">
    @foreach(array_chunk($items->all(), 3) as $row)
        <div class="row">
            @foreach($row as $item)
                @include('partials._item')
            @endforeach
        </div>
    @endforeach
</div>

{{ $items->links() }}
@stop