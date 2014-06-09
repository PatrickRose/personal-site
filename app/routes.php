<?php

Route::get(
    'blog/feed',
    [
        "as" => "rss",
        "uses" => "StaticPagesController@feedPage"
    ]
);

Route::get(
    'shop/{id}/buy',
    [
        "as" => "shop.buy",
        "uses" => "ShopController@buy"
    ]
);

Route::get(
    'shop/basket',
    [
        "as" => "shop.basket",
        "uses" => "ShopController@basket"
    ]
);

Route::get(
    'shop/basket/empty',
    [
        "as" => "shop.empty",
        "uses" => "ShopController@emptyBasket"
    ]
);

Route::get(
    'shop/basket/remove/{id}',
    [
        "as" => "shop.remove",
        "uses" => "ShopController@removeItem"
    ]
);

Route::resource('sessions', 'SessionsController', array("only" => array("create", "store")));
Route::resource('blog', 'BlogsController');
Route::resource('shop', 'ShopController');

Route::get(
    'tag/{tag}',
    array(
        'uses' => 'BlogsController@tagged',
        'as' => 'blog.tag'
    )
);
Route::get(
    "tag",
    array(
        'uses' => 'TagsController@index',
        'as' => 'tag.index'
    )
);

Route::get(
    'login',
    array(
        'uses' => 'SessionsController@create',
        'as' => 'login',
        'before' => 'guest'
    )
);

Route::get(
    'logout',
    array(
        'uses' => 'SessionsController@destroy',
        'as' => 'logout',
        'before' => 'auth'
    )
);

Route::get(
    '/',
    array(
        'uses' => 'StaticPagesController@homePage',
        'as' => 'home'
    )
);

Route::get(
    'admin',
    array(
        'uses' => 'StaticPagesController@homePage',
        'as' => 'admin'
    )
);

Route::get(
    'about',
    array(
        'uses' => 'StaticPagesController@aboutPage',
        'as' => 'about'
    )
);

Route::get(
    'gigs',
    array(
        'uses' => 'StaticPagesController@gigPage',
        'as' => 'gigs'
    )
);
