@extends('layouts.master')

@section('title')
    Basket
@stop

@section('content')
<h2>
    Basket
</h2>

@if(count($items) > 0)
    <table class="table table-striped">
        <thead>
        <tr>
            <th>
                Item
            </th>
            <th>
                Cost
            </th>
            <th>
                Remove?
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>
                        {{ $item->present()->showPrice }}
                    </td>
                    <td>
                        {{ link_to_route('shop.remove', "Remove", $item->id, ["class" => "btn btn-basket"]) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            {{ $total->title }}: <strong>{{ $total->present()->showPrice }}</strong>
        </div>
        <div class="col-md-6">
            {{ link_to_route('shop.empty', "Empty Basket", null, ["class"=>"btn btn-basket"]) }}
        </div>
    </div>


@else
    Your basket is empty. Go {{ link_to_route('shop.index', 'buy stuff!') }}
@endif
@stop