<?php

namespace PatrickRose\Repositories;

use Shop;

class DbShopRepository implements ShopRepositoryInterface {

    public function create($input)
    {
        Shop::create($input);
    }

    public function all($paginate = 18)
    {
        return Shop::paginate($paginate);
    }
}