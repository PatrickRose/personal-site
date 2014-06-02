<?php

namespace PatrickRose\Presenters;

use Laracasts\Presenter\Presenter;

class ShopPresenter extends Presenter {

    public function showPrice()
    {
        $price = $this->price / 100;
        $price = explode(".", "£{$price}");
        if (isset($price[1])) {
            if (strlen($price[1]) == 2) {
                return $price[0] . "." . $price[1];
            } else {
                return $price[0] . "." . $price[1] . "0";
            }
        }
        return $price[0] . ".00";
    }

} 