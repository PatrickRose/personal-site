<?php

use Laracasts\Presenter\PresentableTrait;

class Shop extends \Eloquent {
	protected $fillable = ["title", "description", "price"];

    protected $presenter = "PatrickRose\\Presenters\\ShopPresenter";

    use PresentableTrait;
}