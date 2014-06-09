<div class="shop-item">
    <div class="shop-header">
        <div class="row">
            <div class="shop-title">
                {{ $item->title }}
            </div>
            <div class="shop-price">
                {{ ($item->present()->showPrice())}}
            </div>
        </div>
    </div>
    <div class="shop-description">
        {{ $item->description }}
    </div>
    <div class="shop-buy">
        {{ link_to_route('shop.buy', 'Buy Item', $item->id, ['class'=>"btn btn-shop"]) }}
    </div>
</div>
